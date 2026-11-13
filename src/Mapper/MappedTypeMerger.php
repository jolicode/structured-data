<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Mapper;

use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;

/**
 * Reconciles the structured data blocks of a document that describe the same
 * node.
 *
 * Google reads a page as one graph: the blocks sharing an identifier (a JSON-LD
 * "@id", a microdata "itemid") are one node holding the union of their
 * properties, whatever their format, and a property one block omits is not
 * missing when another block provides it. The blocks are still audited one by
 * one, with their positions in the document; the merged node only tells which
 * of their "missing property" issues Google would not report.
 *
 * @phpstan-type Conflict array{key: string, properties: list<MappedProperty>, values: list<scalar>}
 */
final class MappedTypeMerger
{
    /**
     * Groups the types describing the same node: the ones sharing an absolute
     * identifier. Blank node identifiers are local to their block and never
     * merge.
     *
     * @param array<MappedType> $types
     *
     * @return array<string, list<MappedType>> the groups of two types or more, indexed by identifier
     */
    public static function groupByIdentifier(array $types): array
    {
        $groups = [];

        foreach ($types as $type) {
            $identifier = $type->getProperty(Keyword::ID->value)?->getValue();

            if (!\is_string($identifier) || IriResolver::isBlankNodeIdentifier($identifier) || !IriResolver::isAbsoluteIri($identifier)) {
                continue;
            }

            $groups[$identifier][] = $type;
        }

        return array_filter($groups, static fn (array $group): bool => isset($group[1]));
    }

    /**
     * Builds the node Google sees: a fresh type, free of any error, holding the
     * union of the members' types and properties. Equal scalar values are kept
     * once, nested nodes are all kept, as in a graph.
     *
     * @param list<MappedType> $members
     *
     * @return array{type: MappedType, conflicts: list<Conflict>}
     */
    public static function merge(array $members): array
    {
        $merged = new MappedType(sourceFormat: $members[0]->getSourceFormat(), type: self::unionOfTypes($members));

        /** @var array<string, list<MappedProperty>> $sources */
        $sources = [];

        foreach ($members as $member) {
            foreach ($member->getProperties() as $key => $property) {
                $sources[$key][] = $property;
            }
        }

        $conflicts = [];

        foreach ($sources as $key => $properties) {
            $property = new MappedProperty($key, $merged);
            $values = [];
            $scalars = [];

            foreach ($properties as $source) {
                foreach ($source->getKeyRanges() as $range) {
                    $property->addKeyRange($range);
                }

                foreach ($source->getValueRanges() as $range) {
                    $property->addValueRange($range);
                }

                foreach (self::valuesOf($source) as $value) {
                    if ($value instanceof MappedType) {
                        $values[] = self::copyType($value, $merged, $property);

                        continue;
                    }

                    if (\is_scalar($value)) {
                        if (\in_array($value, $scalars, true)) {
                            continue;
                        }

                        $scalars[] = $value;
                    }

                    $values[] = $value;
                }
            }

            $property->setValue(isset($values[1]) ? $values : ($values[0] ?? null));
            $merged->setProperty($key, $property);

            if (isset($scalars[1]) && '@' !== $key[0]) {
                $conflicts[] = ['key' => $key, 'properties' => $properties, 'values' => $scalars];
            }
        }

        return ['type' => $merged, 'conflicts' => $conflicts];
    }

    /**
     * Withdraws, from the members, the "missing property" issues the merged node
     * does not have: another block provides what they report missing. The
     * members' validity and severities are recomputed afterwards.
     *
     * @param list<MappedType> $members
     *
     * @return list<MappedError> the withdrawn issues
     */
    public static function withdrawIssuesResolvedBy(MappedType $merged, array $members): array
    {
        $remaining = [];

        foreach ($merged->getMergedErrors() as $error) {
            if (null !== $error->getMissingProperty()) {
                $remaining[self::issueKey($error)] = true;
            }
        }

        $withdrawn = [];

        foreach ($members as $member) {
            foreach ($member->getMergedErrors() as $error) {
                if (null === $error->getMissingProperty() || isset($remaining[self::issueKey($error)])) {
                    continue;
                }

                self::withdraw($member, $error);
                $withdrawn[] = $error;
            }

            self::recompute($member);
        }

        return $withdrawn;
    }

    /**
     * @param list<MappedType> $members
     *
     * @return string|list<string>|null
     */
    private static function unionOfTypes(array $members): string|array|null
    {
        $labels = [];

        foreach ($members as $member) {
            foreach ((array) $member->getType() as $label) {
                if (!\in_array($label, $labels, true)) {
                    $labels[] = $label;
                }
            }
        }

        return match (\count($labels)) {
            0 => null,
            1 => $labels[0],
            default => $labels,
        };
    }

    /**
     * The values of a property, one by one: a multi-valued property is a list,
     * a keyword-keyed value (a language map, a list object) is one opaque value.
     *
     * @return list<mixed>
     */
    private static function valuesOf(MappedProperty $property): array
    {
        $value = $property->getValue();

        if (\is_array($value) && array_is_list($value)) {
            return $value;
        }

        return [$value];
    }

    private static function copyType(MappedType $source, MappedType $parent, MappedProperty $parentProperty): MappedType
    {
        $copy = new MappedType(
            sourceFormat: $source->getSourceFormat(),
            type: $source->getType(),
            originalType: $source->getOriginalType(),
            name: $source->getName(),
            parent: $parent,
            parentProperty: $parentProperty,
        );

        foreach ($source->getKeyRanges() as $range) {
            $copy->addKeyRange($range);
        }

        foreach ($source->getValueRanges() as $range) {
            $copy->addValueRange($range);
        }

        foreach ($source->getProperties() as $key => $property) {
            $copy->setProperty($key, self::copyProperty($property, $copy));
        }

        return $copy;
    }

    private static function copyProperty(MappedProperty $source, MappedType $owner): MappedProperty
    {
        $copy = new MappedProperty($source->getKey(), $owner, $source->getOriginalKey());

        foreach ($source->getKeyRanges() as $range) {
            $copy->addKeyRange($range);
        }

        foreach ($source->getValueRanges() as $range) {
            $copy->addValueRange($range);
        }

        $copy->setValue(self::copyValue($source->getValue(), $owner, $copy));

        return $copy;
    }

    private static function copyValue(mixed $value, MappedType $owner, MappedProperty $property): mixed
    {
        if ($value instanceof MappedType) {
            return self::copyType($value, $owner, $property);
        }

        if (\is_array($value)) {
            $copied = [];

            foreach ($value as $key => $entry) {
                $copied[$key] = self::copyValue($entry, $owner, $property);
            }

            return $copied;
        }

        return $value;
    }

    /**
     * What makes two "missing property" issues the same across the members and
     * the merged node: where in the node they are (relative to the root, whose
     * label may differ), what is missing, and how badly.
     */
    private static function issueKey(MappedError $error): string
    {
        $target = $error->getParent();
        $path = $target instanceof MappedType && null === $target->getParentProperty()
            ? ''
            : ($target?->getPath() ?? '');

        return $path . '|' . $error->getMissingProperty() . '|' . $error->getSeverity();
    }

    /**
     * Removes the error from the whole tree of the type: the error of a
     * multi-typed entry is raised on a short-lived clone and copied onto the
     * entry, so its own parent cannot be trusted to find where it is held.
     */
    private static function withdraw(MappedType $type, MappedError $error): void
    {
        $type->removeError($error);
        $type->removeChildrenError($error);

        foreach ($type->getProperties() as $property) {
            $property->removeError($error);

            foreach (self::valuesOf($property) as $value) {
                if ($value instanceof MappedType) {
                    self::withdraw($value, $error);
                }
            }
        }
    }

    /**
     * Recomputes the validity and severity of a type tree from the errors it
     * still holds: a type is valid when it has no error of its own and its
     * nested types are valid, and carries the highest severity found on it or
     * below it.
     */
    private static function recompute(MappedType $type): bool
    {
        $valid = [] === $type->getErrors();

        foreach ($type->getProperties() as $property) {
            $propertyValid = [] === $property->getErrors();
            $property->setErrorSeverity(self::highestSeverity($property->getErrors()));

            foreach (self::valuesOf($property) as $value) {
                if ($value instanceof MappedType && !self::recompute($value)) {
                    $propertyValid = false;
                }
            }

            $property->setIsValid($propertyValid);

            if (!$propertyValid) {
                $valid = false;
            }
        }

        $type->setIsValid($valid);
        $type->setErrorSeverity(self::highestSeverity($type->getMergedErrors()));

        return $valid;
    }

    /**
     * @param array<MappedError> $errors
     */
    private static function highestSeverity(array $errors): ?string
    {
        $severity = null;

        foreach ($errors as $error) {
            if (MappedError::SEVERITY_ERROR === $error->getSeverity()) {
                return MappedError::SEVERITY_ERROR;
            }

            $severity = $error->getSeverity();
        }

        return $severity;
    }
}
