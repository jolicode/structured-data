<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators\SchemaOrg;

use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Vocabularies\Generated\GeneratedClassesRegistry;
use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property\AdditionalPropertyModel;
use JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyValueSpecificationModel;
use JoliCode\StructuredData\Vocabularies\Validators\AbstractValidator;

class SchemaOrgValidator extends AbstractValidator
{
    public const VALIDATOR_NAME = 'SchemaOrg';

    /**
     * Version of the schema.org vocabulary the shipped, generated classes were built
     * from. Bump it together with the generator's version when upgrading schema.org
     * (see resources/schema.org/UPGRADE_GUIDELINES.md).
     */
    public const VOCABULARY_VERSION = '30.0';

    private const SCHEMA_ORG_DOMAIN = 'http://schema.org/';
    private const SCHEMA_ORG_DOMAIN_SECURE = 'https://schema.org/';

    /**
     * Terms hosted under pending.schema.org are still under development and may
     * change or be removed: using them deserves a warning. The other hosted
     * extensions (health-lifesci, bib, auto, meta) are stable vocabulary; their
     * provenance is exposed through getIsPartOf() without a warning.
     */
    private const PENDING_EXTENSION_DOMAIN = 'https://pending.schema.org';

    private const GENERATED_ENUMERATION_MEMBER_NAMESPACE = 'JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\EnumerationMember';

    /**
     * @var array<string, string>|null
     */
    private static ?array $knownEnumerationMembersByLowercase = null;

    public function validateType(MappedType $type): array
    {
        $errors = $this->validateDuplicateKeys($type);
        $typeLabel = $type->getType();
        $parentProperty = $type->getParentProperty();
        $errorTarget = $parentProperty ?: $type;

        if (
            $parentProperty
            && \is_array($typeLabel)
            && \count($typeLabel) > 1
        ) {
            // @see https://www.w3.org/TR/json-ld/#specifying-the-type
            $message = \sprintf('A typed value may only have one type, %d provided', \count($typeLabel));
            $errors[] = self::addMappedError(
                $type->getProperty(Keyword::TYPE->value) ?? $errorTarget,
                $message,
                $type,
                MappedError::SEVERITY_ERROR,
            );

            return $errors;
        }

        if (null === $typeLabel) {
            if (!$type->getParent()) {
                $message = 'Missing a @type entry. The @type entry is mandatory for root types';
                $errors[] = self::addMappedError($errorTarget, $message, $type, MappedError::SEVERITY_ERROR);

                return $errors;
            }

            // Ignore nested foreign-vocabulary nodes (e.g. JSON-LD security proof graphs)
            // referenced by absolute-IRI properties: they are outside schema.org scope.
            if ($parentProperty && IriResolver::isAbsoluteIri($parentProperty->getKey())) {
                return $errors;
            }

            $typeLabel = $this->guessTypeFromProperties($type->getProperties(), $parentProperty?->getKey());
            $type->setType($typeLabel);
            $message = 'The @type entry of this type was not set. We had to guess it from its properties. The guessed type is: ' . $typeLabel;
            $errors[] = self::addMappedError($errorTarget, $message, $type, MappedError::SEVERITY_WARNING);
        }

        $errors = [
            ...$errors,
            ...$this->validateTypeCasing($type, $errorTarget),
        ];

        foreach ((array) $typeLabel as $label) {
            if (!$label || IriResolver::isAbsoluteIri($label)) {
                continue;
            }

            $typeFqcn = $this->getTypeFqcn($label);

            if (!GeneratedClassesRegistry::has($typeFqcn)) {
                $message = \sprintf('The "%s" type is not a valid Schema.org type', $label);
                $errors[] = self::addMappedError(
                    $type->getProperty(Keyword::TYPE->value) ?? $errorTarget,
                    $message,
                    $type,
                    MappedError::SEVERITY_ERROR,
                );

                continue;
            }

            $type->setDescription($typeFqcn::DESCRIPTION);
            $type->setIsPartOf(array_merge($type->getIsPartOf(), $typeFqcn::IS_PART_OF));
            $type->setSource(array_merge($type->getSource(), $typeFqcn::SOURCE));

            if (null !== $typeFqcn::SUPERSEDED_BY) {
                $errors[] = self::addMappedError(
                    $type->getProperty(Keyword::TYPE->value) ?? $errorTarget,
                    \sprintf('The "%s" type is superseded by "%s". Consider using "%s" instead.', $label, $typeFqcn::SUPERSEDED_BY, $typeFqcn::SUPERSEDED_BY),
                    $type,
                    MappedError::SEVERITY_WARNING,
                );
            }

            if (\in_array(self::PENDING_EXTENSION_DOMAIN, $typeFqcn::IS_PART_OF, true)) {
                $errors[] = self::addMappedError(
                    $type->getProperty(Keyword::TYPE->value) ?? $errorTarget,
                    \sprintf('The "%s" type is part of the pending.schema.org extension: it is still under development and subject to change.', $label),
                    $type,
                    MappedError::SEVERITY_WARNING,
                );
            }

            if ($parentProperty && !IriResolver::isAbsoluteIri($parentProperty->getKey())) {
                $parentPropertyKey = $this->stripActionSuffixes($parentProperty->getKey());

                if (!GeneratedClassesRegistry::has($this->getPropertyFqcn($parentPropertyKey))) {
                    return $errors;
                }

                if (!self::propertyTypeIsValid($parentProperty->getKey(), $typeFqcn)) {
                    $message = \sprintf('The "%s" property does not accept the "%s" type as a value', $parentProperty->getKey(), $typeFqcn::LABEL);
                    $errors[] = self::addMappedError($errorTarget, $message, $type, MappedError::SEVERITY_ERROR);
                }
            }
        }

        return $errors;
    }

    public function validateProperty(MappedType $type, MappedProperty $property, ?MappedProperty $originalProperty = null): array
    {
        $errors = $this->validatePropertyCasing($type, $property);
        $typeLabel = $type->getType();

        if (!$typeLabel && !$type->getParent()) {
            return $errors;
        }

        $propertyKey = $this->stripActionSuffixes($property->getKey());

        if (Keyword::tryFrom($propertyKey) || IriResolver::isAbsoluteIri($propertyKey)) {
            return $errors;
        }

        $propertyFqcn = $this->getPropertyFqcn($propertyKey);

        if (!GeneratedClassesRegistry::has($propertyFqcn)) {
            $message = \sprintf('This property does not exist: %s', $propertyKey);

            $errors[] = self::addMappedError($property, $message, $type, MappedError::SEVERITY_ERROR);

            return $errors;
        }

        $property->setDescription($propertyFqcn::DESCRIPTION);
        $property->addIsPartOf($propertyFqcn::IS_PART_OF);
        $property->addSource($propertyFqcn::SOURCE);

        if (null !== $propertyFqcn::SUPERSEDED_BY) {
            $errors[] = self::addMappedError(
                $property,
                \sprintf('The "%s" property is superseded by "%s". Consider using "%s" instead.', $propertyKey, $propertyFqcn::SUPERSEDED_BY, $propertyFqcn::SUPERSEDED_BY),
                $type,
                MappedError::SEVERITY_WARNING,
            );
        }

        if (\in_array(self::PENDING_EXTENSION_DOMAIN, $propertyFqcn::IS_PART_OF, true)) {
            $errors[] = self::addMappedError(
                $property,
                \sprintf('The "%s" property is part of the pending.schema.org extension: it is still under development and subject to change.', $propertyKey),
                $type,
                MappedError::SEVERITY_WARNING,
            );
        }

        if (!$typeLabel) {
            $typeLabel = self::guessTypeFromProperties($type->getProperties(), $originalProperty?->getKey());
        }

        $typeFqcns = [];
        $propertyIsValid = false;
        $typeExists = false;

        foreach ((array) $typeLabel as $label) {
            $typeFqcn = self::getTypeFqcn($label);
            $typeFqcns[] = $typeFqcn;

            if (GeneratedClassesRegistry::has($typeFqcn)) {
                $typeExists = true;

                if (
                    !$propertyIsValid && (
                        property_exists($typeFqcn, $propertyKey)
                        || str_contains($typeFqcn::LABEL, 'Role')
                        || (AdditionalPropertyModel::LABEL === $propertyKey)
                    )
                ) {
                    $propertyIsValid = true;
                }
            }
        }

        if (!$typeExists) {
            return $errors;
        }

        if (!$propertyIsValid) {
            if (\is_string($typeLabel) || (\is_array($typeLabel) && 1 === \count($typeLabel))) {
                $singleTypeLabel = \is_string($typeLabel) ? $typeLabel : $typeLabel[0];
                $message = \sprintf('The property "%s" does not exist on the type "%s"', $propertyKey, $singleTypeLabel);
            } else {
                $message = \sprintf('The property "%s" does not exist on any of these types: "%s"', $propertyKey, implode(', ', $typeLabel));
            }

            $errors[] = self::addMappedError($property, $message, $type, MappedError::SEVERITY_ERROR);

            return $errors;
        }

        $errors = [
            ...$errors,
            ...$this->validateEnumerationIriValues($property, $propertyFqcn, $type),
        ];

        return $errors;
    }

    /**
     * @param array<MappedProperty> $typeProperties
     */
    public function guessTypeFromProperties(
        array $typeProperties,
        ?string $parentProperty = null,
    ): string {
        /**
         * @var array<string, array{fqcn: string, shortName: string, supportedProperties: string[], ancestors: string[], parentsChainLength: int}> $possibleTypes
         */
        $possibleTypes = [];
        $evaluatedPropertiesCount = 0;

        if ($parentProperty && $guessedType = self::guessFromParentProperty($parentProperty, $typeProperties)) {
            return $guessedType;
        }

        foreach ($typeProperties as $property) {
            if (Keyword::tryFrom($property->getKey())) {
                continue;
            }

            $propertyKey = $this->stripActionSuffixes($property->getKey());
            $propertyFqcn = $this->getPropertyFqcn($propertyKey);

            if (!GeneratedClassesRegistry::has($propertyFqcn)) {
                continue;
            }

            ++$evaluatedPropertiesCount;

            /** @var string $fqcn */
            foreach ($propertyFqcn::TYPES as $shortName => $fqcn) {
                if (!isset($possibleTypes[$fqcn])) {
                    $possibleTypes[$fqcn] = [
                        'fqcn' => $fqcn,
                        'shortName' => $shortName,
                        'supportedProperties' => [],
                        'ancestors' => [],
                        'parentsChainLength' => 0,
                    ];
                }

                $possibleTypes[$fqcn]['supportedProperties'][] = $property->getKey();
                $possibleTypes[$fqcn]['ancestors'] = array_merge($possibleTypes[$fqcn]['ancestors'], $fqcn::PARENTS);
            }
        }

        foreach ($possibleTypes as $fqcn => $possibleType) {
            foreach ($possibleType['ancestors'] as $ancestor) {
                if (isset($possibleTypes[$ancestor])) {
                    $possibleTypes[$fqcn]['supportedProperties'] = array_unique(array_merge($possibleType['supportedProperties'], $possibleTypes[$ancestor]['supportedProperties']));
                }
            }
        }

        // filter out the found types that do not have all the properties
        /** @var array<string,array{shortName:string,parentsChainLength:int}> $possibleTypes */
        $possibleTypes = array_filter($possibleTypes, static fn ($possibleType) => \count($possibleType['supportedProperties']) === $evaluatedPropertiesCount);

        if (\count($possibleTypes) > 1) {
            foreach ($possibleTypes as $fqcn => $possibleType) {
                $possibleTypes[$fqcn]['parentsChainLength'] = $this->countLonguestParentsChain($fqcn);
            }

            usort($possibleTypes, static fn (array $a, array $b) => $a['parentsChainLength'] <=> $b['parentsChainLength']);

            return $possibleTypes[0]['shortName'];
        }

        if (1 === \count($possibleTypes)) {
            return array_pop($possibleTypes)['shortName'];
        }

        return 'Thing';
    }

    /**
     * @return array<MappedError>
     */
    private function validateEnumerationIriValues(MappedProperty $property, string $propertyFqcn, MappedType $type): array
    {
        $errors = [];

        // Keep this strict check scoped to itemListOrder where schema.org strongly recommends
        // Enumeration members and where we observed real-world false negatives.
        if ('itemListOrder' !== $property->getKey()) {
            return $errors;
        }

        $enumerationTypeFqcns = $this->getExpectedEnumerationTypeFqcns($propertyFqcn);

        if ([] === $enumerationTypeFqcns) {
            return $errors;
        }

        foreach ($this->extractScalarStringValues($property->getValue()) as $value) {
            if (!IriResolver::isAbsoluteIri($value) || !$this->isSchemaOrgIri($value)) {
                continue;
            }

            $isExpectedEnumerationMemberIri = $this->isExpectedEnumerationMemberIri($value, $enumerationTypeFqcns);

            if (true === $isExpectedEnumerationMemberIri || null === $isExpectedEnumerationMemberIri) {
                continue;
            }

            $errors[] = self::addMappedError(
                $property,
                \sprintf('The value "%s" is not a valid enumeration member for the "%s" property', $value, $property->getKey()),
                $type,
                MappedError::SEVERITY_ERROR,
            );
        }

        return $errors;
    }

    /**
     * @return array<string>
     */
    private function extractScalarStringValues(mixed $value): array
    {
        if (\is_string($value)) {
            return [$value];
        }

        if (!\is_array($value)) {
            return [];
        }

        $scalarValues = [];

        foreach ($value as $entry) {
            if (\is_string($entry)) {
                $scalarValues[] = $entry;
            }
        }

        return $scalarValues;
    }

    /**
     * @return array<string>
     */
    private function getExpectedEnumerationTypeFqcns(string $propertyFqcn): array
    {
        $enumerationTypeFqcns = [];

        foreach ($propertyFqcn::VALUES as $expectedValueTypeFqcn) {
            if (!GeneratedClassesRegistry::has($expectedValueTypeFqcn)) {
                continue;
            }

            if (!\defined($expectedValueTypeFqcn . '::PARENTS') || !\defined($expectedValueTypeFqcn . '::ENUMERATION_MEMBERS')) {
                continue;
            }

            if (!\in_array('JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Type\\EnumerationModel', $expectedValueTypeFqcn::PARENTS, true)) {
                continue;
            }

            $enumerationTypeFqcns[] = $expectedValueTypeFqcn;
        }

        return $enumerationTypeFqcns;
    }

    /**
     * @param array<string> $enumerationTypeFqcns
     */
    private function isExpectedEnumerationMemberIri(string $value, array $enumerationTypeFqcns): ?bool
    {
        $label = str_replace([self::SCHEMA_ORG_DOMAIN, self::SCHEMA_ORG_DOMAIN_SECURE], '', $value);
        $labelLowercase = strtolower($label);

        foreach ($enumerationTypeFqcns as $enumerationTypeFqcn) {
            foreach ($enumerationTypeFqcn::ENUMERATION_MEMBERS as $memberClass) {
                $memberFqcn = $this->resolveEnumerationMemberFqcn($memberClass);

                if (!GeneratedClassesRegistry::has($memberFqcn)) {
                    continue;
                }

                if (strtolower($memberFqcn::LABEL) === $labelLowercase) {
                    return true;
                }
            }
        }

        if (!isset($this->getKnownEnumerationMembersByLowercase()[$labelLowercase])) {
            // Unknown schema.org term (potentially from a newer schema.org release): ignore it.
            return null;
        }

        return false;
    }

    private function resolveEnumerationMemberFqcn(string $memberClass): string
    {
        if (str_starts_with($memberClass, 'JoliCode\\StructuredData\\')) {
            return $memberClass;
        }

        return \sprintf('JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\%s', $memberClass);
    }

    private function isSchemaOrgIri(string $value): bool
    {
        return str_starts_with($value, self::SCHEMA_ORG_DOMAIN)
            || str_starts_with($value, self::SCHEMA_ORG_DOMAIN_SECURE);
    }

    /**
     * @return array<string, string>
     */
    private function getKnownEnumerationMembersByLowercase(): array
    {
        if (null !== self::$knownEnumerationMembersByLowercase) {
            return self::$knownEnumerationMembersByLowercase;
        }

        self::$knownEnumerationMembersByLowercase = [];

        foreach (GeneratedClassesRegistry::getShortNamesByPrefix(self::GENERATED_ENUMERATION_MEMBER_NAMESPACE) as $shortName) {
            $typeName = str_replace('Model', '', $shortName);
            self::$knownEnumerationMembersByLowercase[strtolower($typeName)] = $typeName;
        }

        return self::$knownEnumerationMembersByLowercase;
    }

    private function guessFromParentProperty(string $parentProperty, array $typeProperties): ?string
    {
        $parentPropertyKey = $this->stripActionSuffixes($parentProperty);
        $parentPropertyFqcn = $this->getPropertyFqcn($parentPropertyKey);
        $bestMatches = [];

        if (!GeneratedClassesRegistry::has($parentPropertyFqcn)) {
            return null;
        }

        foreach ($parentPropertyFqcn::VALUES as $expectedFqcn) {
            $commonProperties = array_intersect_key(
                array_map(static fn (MappedProperty $property) => $property->getKey(), $typeProperties),
                get_class_vars($expectedFqcn),
            );

            $bestMatches[\count($commonProperties)] = $expectedFqcn::LABEL;
        }

        ksort($bestMatches);

        return array_pop($bestMatches);
    }

    private function countLonguestParentsChain(string $fqcn): int
    {
        if (!$fqcn::PARENTS) {
            return 0;
        }

        $longuestParentsChainLength = 0;

        foreach ($fqcn::PARENTS as $parentType) {
            $longuestParentsChainLength = max($this->countLonguestParentsChain($parentType), $longuestParentsChainLength);
        }

        return $longuestParentsChainLength + 1;
    }

    private function getTypeFqcn(string $typeShortName): string
    {
        return \sprintf('JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Type\\%sModel', $typeShortName);
    }

    private function getPropertyFqcn(string $propertyShortName): string
    {
        return \sprintf('JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Property\\%sModel', ucfirst($propertyShortName));
    }

    private function stripActionSuffixes(string $propertyLabel): string
    {
        if (!str_contains($propertyLabel, '-')) {
            return $propertyLabel;
        }

        return str_replace(['-input', '-output'], '', $propertyLabel);
    }

    private function propertyTypeIsValid(string $propertyLabel, string $typeFqcn): bool
    {
        // Ok this may look weird but take a look at http://blog.schema.org/2014/06/introducing-role.html
        if (str_contains($typeFqcn::LABEL, 'Role')) {
            return true;
        }

        if (PropertyValueSpecificationModel::class === $typeFqcn && (
            str_ends_with($propertyLabel, '-input')
            || str_ends_with($propertyLabel, '-output')
        )) {
            return true;
        }

        $propertyFqcn = $this->getPropertyFqcn($propertyLabel);

        if (!GeneratedClassesRegistry::has($propertyFqcn)) {
            return false;
        }

        $propertyValues = $propertyFqcn::VALUES;

        if (\in_array($typeFqcn, $propertyValues, true)) {
            return true;
        }

        foreach ($typeFqcn::PARENTS as $parentType) {
            if (self::propertyTypeIsValid($propertyLabel, $parentType)) {
                return true;
            }
        }

        return false;
    }
}
