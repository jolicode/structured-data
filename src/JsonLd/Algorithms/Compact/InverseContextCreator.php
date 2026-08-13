<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Compact;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinition;

final class InverseContextCreator
{
    public const ANY = '@any';
    public const NULL = '@null';

    /**
     * This is a PHP implementation of the Inverse Context Creation algorithm based
     * on the JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published
     * on July 16th, 2020.
     *
     * @see https://www.w3.org/TR/json-ld-api/#inverse-context-creation
     *
     * @return array<string, array<string, array<string, array<string, string>>>>
     */
    public static function create(Context $activeContext): array
    {
        // 1
        /** @var array<string, array<string, array<string, array<string, string>>>> $inverse */
        $inverse = [];

        // 2
        $defaultLanguage = null !== $activeContext->defaultLangage
            ? strtolower($activeContext->defaultLangage)
            : Keyword::NONE->value;

        // 3
        $terms = array_keys($activeContext->termDefinitions);
        usort($terms, static function (string $a, string $b): int {
            return \strlen($a) <=> \strlen($b) ?: strcmp($a, $b);
        });

        foreach ($terms as $term) {
            /** @var TermDefinition|null $termDefinition */
            $termDefinition = $activeContext->termDefinitions[$term];

            // 3.1
            if (null === $termDefinition) {
                continue;
            }

            // 3.2
            $container = Keyword::NONE->value;

            if ($termDefinition->containerMapping) {
                $containerMapping = $termDefinition->containerMapping;
                sort($containerMapping);
                $container = implode('', $containerMapping);
            }

            // 3.3
            $variable = (string) $termDefinition->iriMapping;

            // 3.4
            if (!isset($inverse[$variable])) {
                $inverse[$variable] = [];
            }

            // 3.5
            // 3.6
            if (!isset($inverse[$variable][$container])) {
                $inverse[$variable][$container] = [
                    Keyword::LANGUAGE->value => [],
                    Keyword::TYPE->value => [],
                    self::ANY => [Keyword::NONE->value => $term],
                ];
            }

            // 3.7
            // 3.8
            $typeLanguageMap = &$inverse[$variable][$container];

            if ($termDefinition->reverseProperty) {
                // 3.9
                if (!isset($typeLanguageMap[Keyword::TYPE->value][Keyword::REVERSE->value])) {
                    $typeLanguageMap[Keyword::TYPE->value][Keyword::REVERSE->value] = $term;
                }
            } elseif (Keyword::NONE->value === $termDefinition->typeMapping) {
                // 3.10
                if (!isset($typeLanguageMap[Keyword::LANGUAGE->value][self::ANY])) {
                    $typeLanguageMap[Keyword::LANGUAGE->value][self::ANY] = $term;
                }

                if (!isset($typeLanguageMap[Keyword::TYPE->value][self::ANY])) {
                    $typeLanguageMap[Keyword::TYPE->value][self::ANY] = $term;
                }
            } elseif (null !== $termDefinition->typeMapping) {
                // 3.11
                if (!isset($typeLanguageMap[Keyword::TYPE->value][$termDefinition->typeMapping])) {
                    $typeLanguageMap[Keyword::TYPE->value][$termDefinition->typeMapping] = $term;
                }
            } elseif (false !== $termDefinition->languageMapping && false !== $termDefinition->directionMapping) {
                // 3.12
                $language = $termDefinition->languageMapping;
                $direction = $termDefinition->directionMapping;

                if (null !== $language && null !== $direction) {
                    $langDir = strtolower($language . '_' . $direction);
                } elseif (null !== $language) {
                    $langDir = strtolower($language);
                } elseif (null !== $direction) {
                    $langDir = '_' . strtolower($direction);
                } else {
                    $langDir = self::NULL;
                }

                if (!isset($typeLanguageMap[Keyword::LANGUAGE->value][$langDir])) {
                    $typeLanguageMap[Keyword::LANGUAGE->value][$langDir] = $term;
                }
            } elseif (false !== $termDefinition->languageMapping) {
                // 3.13
                $language = null !== $termDefinition->languageMapping
                    ? strtolower($termDefinition->languageMapping)
                    : self::NULL;

                if (!isset($typeLanguageMap[Keyword::LANGUAGE->value][$language])) {
                    $typeLanguageMap[Keyword::LANGUAGE->value][$language] = $term;
                }
            } elseif (false !== $termDefinition->directionMapping) {
                // 3.14
                $direction = null !== $termDefinition->directionMapping
                    ? '_' . strtolower($termDefinition->directionMapping)
                    : Keyword::NONE->value;

                if (!isset($typeLanguageMap[Keyword::LANGUAGE->value][$direction])) {
                    $typeLanguageMap[Keyword::LANGUAGE->value][$direction] = $term;
                }
            } elseif (null !== $activeContext->defaultBaseDirection) {
                // 3.15
                $langDir = strtolower(($activeContext->defaultLangage ?? '') . '_' . $activeContext->defaultBaseDirection);

                if (!isset($typeLanguageMap[Keyword::LANGUAGE->value][$langDir])) {
                    $typeLanguageMap[Keyword::LANGUAGE->value][$langDir] = $term;
                }

                if (!isset($typeLanguageMap[Keyword::LANGUAGE->value][Keyword::NONE->value])) {
                    $typeLanguageMap[Keyword::LANGUAGE->value][Keyword::NONE->value] = $term;
                }

                if (!isset($typeLanguageMap[Keyword::TYPE->value][Keyword::NONE->value])) {
                    $typeLanguageMap[Keyword::TYPE->value][Keyword::NONE->value] = $term;
                }
            } else {
                // 3.16
                if (!isset($typeLanguageMap[Keyword::LANGUAGE->value][$defaultLanguage])) {
                    $typeLanguageMap[Keyword::LANGUAGE->value][$defaultLanguage] = $term;
                }

                if (!isset($typeLanguageMap[Keyword::LANGUAGE->value][Keyword::NONE->value])) {
                    $typeLanguageMap[Keyword::LANGUAGE->value][Keyword::NONE->value] = $term;
                }

                if (!isset($typeLanguageMap[Keyword::TYPE->value][Keyword::NONE->value])) {
                    $typeLanguageMap[Keyword::TYPE->value][Keyword::NONE->value] = $term;
                }
            }

            unset($typeLanguageMap);
        }

        // 4
        return $inverse;
    }

    /**
     * This is a PHP implementation of the Term Selection algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * @see https://www.w3.org/TR/json-ld-api/#term-selection
     *
     * @param array<string> $containers
     * @param array<string> $preferredValues
     */
    public static function selectTerm(
        Context $activeContext,
        string $variable,
        array $containers,
        string $typeLanguage,
        array $preferredValues,
    ): ?string {
        // 1
        $activeContext->inverseContext ??= self::create($activeContext);

        // 2
        $containerMap = $activeContext->inverseContext[$variable] ?? [];

        // 3
        foreach ($containers as $container) {
            // 3.1
            if (!isset($containerMap[$container])) {
                continue;
            }

            // 3.2
            // 3.3
            $valueMap = $containerMap[$container][$typeLanguage] ?? [];

            // 3.4
            foreach ($preferredValues as $item) {
                if (isset($valueMap[$item])) {
                    return $valueMap[$item];
                }
            }
        }

        // 4
        return null;
    }
}
