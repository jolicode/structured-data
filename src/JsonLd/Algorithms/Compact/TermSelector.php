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

/**
 * Step 4 of the IRI Compaction algorithm, split out of IriCompactor because it is
 * a self-contained state machine: it reads no compactor state, and only re-enters
 * compaction once, at step 4.16.
 *
 * @see https://www.w3.org/TR/json-ld-api/#iri-compaction
 */
final class TermSelector
{
    /**
     * Steps 4.1 to 4.19 of the IRI Compaction algorithm: when compacting against the
     * vocabulary, find the best matching term for the IRI given the shape (container,
     * type, language) of the value it will hold.
     */
    public static function selectBestMatchingTerm(
        IriCompactor $iriCompactor,
        Context $activeContext,
        string $variable,
        mixed $value,
        bool $reverse,
    ): ?string {
        // 4.1
        if (null !== $activeContext->defaultBaseDirection) {
            $defaultLanguage = strtolower($activeContext->defaultLangage . '_' . $activeContext->defaultBaseDirection);
        } elseif (null !== $activeContext->defaultLangage) {
            $defaultLanguage = strtolower($activeContext->defaultLangage);
        } else {
            $defaultLanguage = Keyword::NONE->value;
        }

        // 4.2
        if ($value instanceof \stdClass && property_exists($value, '@preserve')) {
            $preserved = $value->{'@preserve'};
            $value = \is_array($preserved) ? $preserved[0] : $preserved;
        }

        // 4.3
        $containers = [];

        // 4.4
        $typeLanguage = Keyword::LANGUAGE->value;
        $typeLanguageValue = InverseContextCreator::NULL;

        // 4.5
        if ($value instanceof \stdClass && property_exists($value, Keyword::INDEX->value) && !IriCompactor::isGraphObject($value)) {
            $containers[] = Keyword::INDEX->value;
            $containers[] = Keyword::INDEX->value . Keyword::SET->value;
        }

        if ($reverse) {
            // 4.6
            $typeLanguage = Keyword::TYPE->value;
            $typeLanguageValue = Keyword::REVERSE->value;
            $containers[] = Keyword::SET->value;
        } elseif (IriCompactor::isListObject($value)) {
            // 4.7
            // 4.7.1
            if (!property_exists($value, Keyword::INDEX->value)) {
                $containers[] = Keyword::LIST->value;
            }

            // 4.7.2
            $list = $value->{Keyword::LIST->value};

            // 4.7.3
            $commonType = null;
            $commonLanguage = [] === $list ? $defaultLanguage : null;

            // 4.7.4
            foreach ($list as $item) {
                // 4.7.4.1
                $itemLanguage = Keyword::NONE->value;
                $itemType = Keyword::NONE->value;

                // 4.7.4.2
                if ($item instanceof \stdClass && property_exists($item, Keyword::VALUE->value)) {
                    if (property_exists($item, Keyword::DIRECTION->value)) {
                        // 4.7.4.2.1
                        $itemLanguage = strtolower(($item->{Keyword::LANGUAGE->value} ?? '') . '_' . $item->{Keyword::DIRECTION->value});
                    } elseif (property_exists($item, Keyword::LANGUAGE->value)) {
                        // 4.7.4.2.2
                        $itemLanguage = strtolower((string) $item->{Keyword::LANGUAGE->value});
                    } elseif (property_exists($item, Keyword::TYPE->value)) {
                        // 4.7.4.2.3
                        $itemType = $item->{Keyword::TYPE->value};
                    } else {
                        // 4.7.4.2.4
                        $itemLanguage = InverseContextCreator::NULL;
                    }
                } else {
                    // 4.7.4.3
                    $itemType = Keyword::ID->value;
                }

                // 4.7.4.4
                if (null === $commonLanguage) {
                    $commonLanguage = $itemLanguage;
                } elseif ($commonLanguage !== $itemLanguage && $item instanceof \stdClass && property_exists($item, Keyword::VALUE->value)) {
                    // 4.7.4.5
                    $commonLanguage = Keyword::NONE->value;
                }

                // 4.7.4.6
                if (null === $commonType) {
                    $commonType = $itemType;
                } elseif ($commonType !== $itemType) {
                    // 4.7.4.7
                    $commonType = Keyword::NONE->value;
                }

                // 4.7.4.8
                if (Keyword::NONE->value === $commonLanguage && Keyword::NONE->value === $commonType) {
                    break;
                }
            }

            // 4.7.5
            $commonLanguage ??= Keyword::NONE->value;

            // 4.7.6
            $commonType ??= Keyword::NONE->value;

            // 4.7.7
            if (Keyword::NONE->value !== $commonType) {
                $typeLanguage = Keyword::TYPE->value;
                $typeLanguageValue = $commonType;
            } else {
                // 4.7.8
                $typeLanguageValue = $commonLanguage;
            }
        } elseif (IriCompactor::isGraphObject($value)) {
            // 4.8
            // 4.8.1
            if ($value instanceof \stdClass && property_exists($value, Keyword::INDEX->value)) {
                $containers[] = Keyword::GRAPH->value . Keyword::INDEX->value;
                $containers[] = Keyword::GRAPH->value . Keyword::INDEX->value . Keyword::SET->value;
            }

            // 4.8.2
            if ($value instanceof \stdClass && property_exists($value, Keyword::ID->value)) {
                $containers[] = Keyword::GRAPH->value . Keyword::ID->value;
                $containers[] = Keyword::GRAPH->value . Keyword::ID->value . Keyword::SET->value;
            }

            // 4.8.3
            $containers[] = Keyword::GRAPH->value;
            $containers[] = Keyword::GRAPH->value . Keyword::SET->value;
            $containers[] = Keyword::SET->value;

            // 4.8.4
            if ($value instanceof \stdClass && !property_exists($value, Keyword::INDEX->value)) {
                $containers[] = Keyword::GRAPH->value . Keyword::INDEX->value;
                $containers[] = Keyword::GRAPH->value . Keyword::INDEX->value . Keyword::SET->value;
            }

            // 4.8.5
            if ($value instanceof \stdClass && !property_exists($value, Keyword::ID->value)) {
                $containers[] = Keyword::GRAPH->value . Keyword::ID->value;
                $containers[] = Keyword::GRAPH->value . Keyword::ID->value . Keyword::SET->value;
            }

            // 4.8.6
            $containers[] = Keyword::INDEX->value;
            $containers[] = Keyword::INDEX->value . Keyword::SET->value;

            // 4.8.7
            $typeLanguage = Keyword::TYPE->value;
            $typeLanguageValue = Keyword::ID->value;
        } else {
            // 4.9
            if ($value instanceof \stdClass && property_exists($value, Keyword::VALUE->value)) {
                // 4.9.1
                if (property_exists($value, Keyword::DIRECTION->value) && !property_exists($value, Keyword::INDEX->value)) {
                    // 4.9.1.1
                    $typeLanguageValue = strtolower(($value->{Keyword::LANGUAGE->value} ?? '') . '_' . $value->{Keyword::DIRECTION->value});
                    $containers[] = Keyword::LANGUAGE->value;
                    $containers[] = Keyword::LANGUAGE->value . Keyword::SET->value;
                } elseif (property_exists($value, Keyword::LANGUAGE->value) && !property_exists($value, Keyword::INDEX->value)) {
                    // 4.9.1.2
                    $typeLanguageValue = strtolower((string) $value->{Keyword::LANGUAGE->value});
                    $containers[] = Keyword::LANGUAGE->value;
                    $containers[] = Keyword::LANGUAGE->value . Keyword::SET->value;
                } elseif (property_exists($value, Keyword::TYPE->value)) {
                    // 4.9.1.3
                    $typeLanguage = Keyword::TYPE->value;
                    $typeLanguageValue = $value->{Keyword::TYPE->value};
                }
            } else {
                // 4.9.2
                $typeLanguage = Keyword::TYPE->value;
                $typeLanguageValue = Keyword::ID->value;
                $containers[] = Keyword::ID->value;
                $containers[] = Keyword::ID->value . Keyword::SET->value;
                $containers[] = Keyword::TYPE->value;
                $containers[] = Keyword::SET->value . Keyword::TYPE->value;
            }

            // 4.9.3
            $containers[] = Keyword::SET->value;
        }

        // 4.10
        $containers[] = Keyword::NONE->value;

        // 4.11
        if (Context::PROCESSING_MODE_10 !== $activeContext->processingMode && (!$value instanceof \stdClass || !property_exists($value, Keyword::INDEX->value))) {
            $containers[] = Keyword::INDEX->value;
            $containers[] = Keyword::INDEX->value . Keyword::SET->value;
        }

        // 4.12
        if (
            Context::PROCESSING_MODE_10 !== $activeContext->processingMode
            && $value instanceof \stdClass
            && property_exists($value, Keyword::VALUE->value)
            && 1 === \count(get_object_vars($value))
        ) {
            $containers[] = Keyword::LANGUAGE->value;
            $containers[] = Keyword::LANGUAGE->value . Keyword::SET->value;
        }

        // 4.13
        if (null === $typeLanguageValue) {
            $typeLanguageValue = InverseContextCreator::NULL;
        }

        // 4.14
        $preferredValues = [];

        // 4.15
        if (Keyword::REVERSE->value === $typeLanguageValue) {
            $preferredValues[] = Keyword::REVERSE->value;
        }

        if (
            (Keyword::ID->value === $typeLanguageValue || Keyword::REVERSE->value === $typeLanguageValue)
            && $value instanceof \stdClass
            && property_exists($value, Keyword::ID->value)
        ) {
            // 4.16
            $compactedIdVocab = $iriCompactor->compactIri($activeContext, $value->{Keyword::ID->value}, vocab: true);
            $compactedIdDefinition = null !== $compactedIdVocab
                ? ($activeContext->termDefinitions[$compactedIdVocab] ?? null)
                : null;

            if (
                $compactedIdDefinition instanceof TermDefinition
                && $compactedIdDefinition->iriMapping === $value->{Keyword::ID->value}
            ) {
                // 4.16.1
                $preferredValues[] = Keyword::VOCAB->value;
                $preferredValues[] = Keyword::ID->value;
                $preferredValues[] = Keyword::NONE->value;
            } else {
                // 4.16.2
                $preferredValues[] = Keyword::ID->value;
                $preferredValues[] = Keyword::VOCAB->value;
                $preferredValues[] = Keyword::NONE->value;
            }
        } else {
            // 4.17
            $preferredValues[] = $typeLanguageValue;
            $preferredValues[] = Keyword::NONE->value;

            if (IriCompactor::isListObject($value) && [] === $value->{Keyword::LIST->value}) {
                $typeLanguage = InverseContextCreator::ANY;
            }
        }

        // 4.18
        $preferredValues[] = InverseContextCreator::ANY;

        // 4.19
        if (false !== ($underscorePosition = strpos($typeLanguageValue, '_'))) {
            $preferredValues[] = substr($typeLanguageValue, $underscorePosition);
        }

        // 4.20
        return InverseContextCreator::selectTerm($activeContext, $variable, $containers, $typeLanguage, $preferredValues);
    }
}
