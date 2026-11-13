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
 * Merges the structured data blocks of a document that describe the same node.
 *
 * Google reads a page as one graph: the blocks sharing an identifier (a JSON-LD
 * "@id", a microdata "itemid") are one node holding the union of their
 * properties, whatever their format, and a property one block omits is not
 * missing when another block provides it. The merged node is a fresh tree, to be
 * validated apart: the blocks themselves are left untouched, with their own
 * audit and positions.
 *
 * @phpstan-type Conflict array{key: string, property: MappedProperty, values: list<scalar>}
 */
final class MappedTypeMerger
{
    /**
     * The validator name of the warnings raised on a merged node, when its
     * blocks disagree on a value.
     */
    public const VALIDATOR_NAME = 'Merge';

    /**
     * The identifier under which a type merges with the others: its absolute
     * "@id". Blank node identifiers are local to their block and never merge.
     * Identifiers are compared as they are written.
     */
    public static function identifierOf(MappedType $type): ?string
    {
        $identifier = $type->getProperty(Keyword::ID->value)?->getValue();

        if (!\is_string($identifier) || IriResolver::isBlankNodeIdentifier($identifier) || !IriResolver::isAbsoluteIri($identifier)) {
            return null;
        }

        return $identifier;
    }

    /**
     * Groups the types describing the same node: the ones sharing an identifier
     * (see identifierOf()).
     *
     * @param array<MappedType> $types
     *
     * @return array<string, list<MappedType>> the groups of two types or more, indexed by identifier
     */
    public static function groupByIdentifier(array $types): array
    {
        $groups = [];

        foreach ($types as $type) {
            if (null !== $identifier = self::identifierOf($type)) {
                $groups[$identifier][] = $type;
            }
        }

        return array_filter($groups, static fn (array $group): bool => isset($group[1]));
    }

    /**
     * Builds the node Google sees: a fresh type, free of any error, holding the
     * union of the members' types and properties, and the positions of every
     * member. Equal scalar values are kept once, nested nodes are all kept, as
     * in a graph.
     *
     * @param list<MappedType> $members
     *
     * @return array{type: MappedType, conflicts: list<Conflict>} the merged node, and its properties holding a different scalar value in several members
     */
    public static function merge(array $members): array
    {
        $merged = new MappedType(sourceFormat: $members[0]->getSourceFormat(), type: self::unionOfTypes($members));

        foreach ($members as $member) {
            foreach ($member->getKeyRanges() as $range) {
                $merged->addKeyRange($range);
            }

            foreach ($member->getValueRanges() as $range) {
                $merged->addValueRange($range);
            }
        }

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
                $conflicts[] = ['key' => $key, 'property' => $property, 'values' => $scalars];
            }
        }

        return ['type' => $merged, 'conflicts' => $conflicts];
    }

    /**
     * Raises a warning on each property of the merged node whose members
     * disagree on the value. Google keeps every value and reports nothing, so
     * the warning carries its own validator name, outside the Google verdict.
     * It does not make the node invalid.
     *
     * @param list<Conflict> $conflicts as returned by merge()
     * @param int            $members   the number of blocks merged into the node
     */
    public static function reportConflicts(string $identifier, int $members, array $conflicts): void
    {
        foreach ($conflicts as $conflict) {
            $property = $conflict['property'];
            $owner = $property->getOwnerType();

            $error = new MappedError(
                message: \sprintf(
                    'The %d blocks describing "%s" give it different values (%s): Google merges them and keeps every value.',
                    $members,
                    $identifier,
                    implode(', ', array_map(static fn (mixed $value): string => json_encode($value, \JSON_UNESCAPED_SLASHES | \JSON_UNESCAPED_UNICODE) ?: '', $conflict['values'])),
                ),
                property: $conflict['key'],
                type: MappedErrorFormatter::formatTypeLabel($owner?->getType()),
                severity: MappedError::SEVERITY_WARNING,
                validatorName: self::VALIDATOR_NAME,
                ranges: MappedErrorFormatter::formatRanges($property->getValueRanges()),
                parent: $property,
            );

            $property->addError($error);
            $property->setErrorSeverity($property->getErrorSeverity() ?? MappedError::SEVERITY_WARNING);

            if (null !== $owner) {
                $owner->addChildrenError($error);
                $owner->setErrorSeverity($owner->getErrorSeverity() ?? MappedError::SEVERITY_WARNING);
            }
        }
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
}
