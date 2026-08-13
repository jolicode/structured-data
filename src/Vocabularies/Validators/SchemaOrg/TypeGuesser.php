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

use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Vocabularies\Generated\GeneratedClassesRegistry;

/**
 * Infers the most likely schema.org type of a node from the properties it carries,
 * and builds the fully qualified names of the generated vocabulary classes.
 */
final class TypeGuesser
{
    /**
     * @param array<MappedProperty> $typeProperties
     */
    public static function guessTypeFromProperties(
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

            $propertyKey = self::stripActionSuffixes($property->getKey());
            $propertyFqcn = self::getPropertyFqcn($propertyKey);

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
                $possibleTypes[$fqcn]['parentsChainLength'] = self::countLonguestParentsChain($fqcn);
            }

            usort($possibleTypes, static fn (array $a, array $b) => $a['parentsChainLength'] <=> $b['parentsChainLength']);

            return $possibleTypes[0]['shortName'];
        }

        if (1 === \count($possibleTypes)) {
            return array_pop($possibleTypes)['shortName'];
        }

        return 'Thing';
    }

    public static function getTypeFqcn(string $typeShortName): string
    {
        return \sprintf('JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Type\\%sModel', $typeShortName);
    }

    public static function getPropertyFqcn(string $propertyShortName): string
    {
        return \sprintf('JoliCode\\StructuredData\\Vocabularies\\Generated\\SchemaOrg\\Property\\%sModel', ucfirst($propertyShortName));
    }

    public static function stripActionSuffixes(string $propertyLabel): string
    {
        if (!str_contains($propertyLabel, '-')) {
            return $propertyLabel;
        }

        return str_replace(['-input', '-output'], '', $propertyLabel);
    }

    private static function guessFromParentProperty(string $parentProperty, array $typeProperties): ?string
    {
        $parentPropertyKey = self::stripActionSuffixes($parentProperty);
        $parentPropertyFqcn = self::getPropertyFqcn($parentPropertyKey);
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

    private static function countLonguestParentsChain(string $fqcn): int
    {
        if (!$fqcn::PARENTS) {
            return 0;
        }

        $longuestParentsChainLength = 0;

        foreach ($fqcn::PARENTS as $parentType) {
            $longuestParentsChainLength = max(self::countLonguestParentsChain($parentType), $longuestParentsChainLength);
        }

        return $longuestParentsChainLength + 1;
    }
}
