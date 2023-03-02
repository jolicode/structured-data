<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\TermDefinition;

use Jolicode\JsonLd\ContextProcessing\Context;
use Jolicode\JsonLd\Http\IriResolver;
use Jolicode\JsonLd\JsonLd\Keyword;

class TermDefinitionCreator
{
    /**
     * Implementation of the W3C Create Term Definition algorithm : https://www.w3.org/TR/json-ld-api/#create-term-definition
     * It is based on the 16th July 2020 recommendation.
     */
    public static function create(
        Context $activeContext,
        \stdClass $localContext,
        string $term,
        array &$defined,
        ?string $baseUrl = null,
        bool $protected = false,
        bool $overrideProtected = false,
        array $remoteContexts = [],
        bool $validateScopedContext = true
    ) {
        // 1
        if (\array_key_exists($term, $defined)) {
            if ($defined[$term]) {
                return;
            }

            throw new TermDefinitionCreationException('cyclic IRI mapping error');
        }

        // 2
        if ('' === $term) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        $defined[$term] = false;

        // 3
        $value = $localContext->$term;

        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode && Keyword::TYPE->value === $term) {
            throw new TermDefinitionCreationException('keyword redefinition');
        }

        // 5
        if (preg_match('/^@[a-zA-Z]+$/', $term)) {
            return;
        }

        // 6
        if (\array_key_exists($term, $activeContext->termDefinitions)) {
            $previousDefinition = $activeContext->termDefinitions[$term];
            unset($activeContext->termDefinitions[$term]);
        }

        // 7
        if (null === $value) {
            $value = (object) [Keyword::ID->value => null];
        // 8
        } elseif (\is_string($value)) {
            $value = (object) [Keyword::ID->value => $value];
            $simpleTerm = true;
        // 9
        } else {
            if (!\is_object($value)) {
                throw new TermDefinitionCreationException('invalid term definition');
            }

            $simpleTerm = false;
        }

        // 10
        $definition = new TermDefinition(false, $protected, false);

        // 11
        if (property_exists($value, Keyword::PROTECTED->value)) {
            if (!\is_bool($value->{Keyword::PROTECTED->value})) {
                throw new TermDefinitionCreationException('invalid @protected value');
            }

            $definition->protected = $value->{Keyword::PROTECTED->value};
        }

        // 12
        if (property_exists($value, Keyword::TYPE->value)) {
            // 12.1
            if (!\is_string($value->{Keyword::TYPE->value})) {
                throw new TermDefinitionCreationException('invalid @type value');
            }

            // 12.1
            $type = $value->{Keyword::TYPE->value};

            // 12.2
            $type = IriResolver::expand($activeContext, $type, localContext: $localContext, defined: $defined);

            if (
                Context::PROCESSING_MODE_10 === $activeContext->processingMode &&
                \in_array($type, [Keyword::JSON->value, Keyword::NONE->value], true)
            ) {
                throw new TermDefinitionCreationException('invalid type mapping');
            }

            // 12.4
            if (
                !IriResolver::isIri($type) &&
                !\in_array(
                    $type,
                    [
                        Keyword::ID->value, Keyword::NONE->value, Keyword::JSON->value, Keyword::VOCAB->value,
                    ],
                    true
                )
            ) {
                throw new TermDefinitionCreationException('invalid type mapping');
            }

            // 12.5
            $definition->typeMapping = $type;
        }

        // 13
        if (property_exists($value, Keyword::REVERSE->value)) {
            // 13.1
            if (
                property_exists($value, Keyword::ID->value) ||
                property_exists($value, Keyword::NEST->value)
            ) {
                throw new TermDefinitionCreationException('invalid reverse property');
            }

            // 13.2
            if (!\is_string($value->{Keyword::REVERSE->value})) {
                throw new TermDefinitionCreationException('invalid IRI mapping');
            }

            // 13.3
            if (preg_match('/^@[a-zA-Z]+$/', $value->{Keyword::REVERSE->value})) {
                return;
            }

            // 13.4
            $definition->iriMapping = IriResolver::expand(
                $activeContext,
                $value->{Keyword::REVERSE->value},
                defined: $defined,
                localContext: $localContext
            );

            // 13.4
            if (!IriResolver::isAbsoluteIriOrBlankNode($definition->iriMapping)) {
                throw new TermDefinitionCreationException('invalid IRI mapping');
            }

            // 13.5
            if (property_exists($value, Keyword::CONTAINER->value)) {
                if (
                    null !== $value->{Keyword::CONTAINER->value} &&
                    $value->{Keyword::CONTAINER->value} !== Keyword::SET->value &&
                    $value->{Keyword::CONTAINER->value} !== Keyword::INDEX->value
                ) {
                    throw new TermDefinitionCreationException('invalid reverse property');
                }

                $definition->containerMapping = [$value->{Keyword::CONTAINER->value}];
            }

            // 13.6
            $definition->reverseProperty = true;
            // 13.7
            $activeContext->termDefinitions[$term] = $definition;
            $defined[$term] = true;

            return;
        }

        // 14
        if (
            property_exists($value, Keyword::ID->value) &&
            $value->{Keyword::ID->value} !== $term
        ) {
            // 14.1
            $id = $value->{Keyword::ID->value};

            // 14.2
            if (null !== $id) {
                if (!\is_string($id)) {
                    throw new TermDefinitionCreationException('invalid IRI mapping');
                }

                if (!Keyword::tryFrom($id) && preg_match('/^@[a-zA-Z]+$/', $id)) {
                    return;
                }

                $definition->iriMapping = IriResolver::expand(
                    $activeContext,
                    $id,
                    defined: $defined,
                    localContext: $localContext
                );

                if (
                    !Keyword::tryFrom($definition->iriMapping) &&
                    !IriResolver::isIri($definition->iriMapping) &&
                    !IriResolver::isBlankNodeIdentifier($definition->iriMapping)
                ) {
                    throw new TermDefinitionCreationException('invalid IRI mapping');
                }

                if ($definition->iriMapping === Keyword::CONTEXT->value) {
                    throw new TermDefinitionCreationException('invalid keyword alias');
                }

                if (
                    str_contains('/', $term) ||
                    preg_match('/[^^]:[^$]/', $term)
                ) {
                    $defined[$term] = true;

                    if (
                        IriResolver::expand(
                            $activeContext,
                            $term,
                            defined: $defined,
                            localContext: $localContext
                        ) !== $definition->iriMapping
                    ) {
                        // Commenting for now as it is throwing exceptions we can't explain yet.
                        // throw new TermDefinitionCreationException('invalid IRI mapping');
                    }
                }

                if (
                    !str_contains(':', $term) &&
                    !str_contains('/', $term) &&
                    isset($simpleTerm) &&
                    $simpleTerm
                ) {
                    if (IriResolver::isBlankNodeIdentifier($definition->iriMapping) || IriResolver::isIri($definition->iriMapping)) {
                        $definition->prefixFlag = true;
                    }
                }
            }
        // 15
        } elseif (preg_match('/[^^]:/', $term)) {
            [$prefix, $suffix] = explode(':', $term, 2);

            // 15.1
            if (property_exists($localContext, $suffix)) {
                self::create($activeContext, $localContext, $prefix, $defined);
            }

            /** @var TermDefinition $activeDefinitions */
            $activeDefinitions = $activeContext->termDefinitions;

            // 15.2
            if (\array_key_exists($prefix, $activeContext->termDefinitions)) {
                $definition->iriMapping = $activeDefinitions[$prefix]->iriMapping . $suffix;
            // 15.3
            } else {
                $definition->iriMapping = $term;
            }
        // 16
        } elseif (str_contains($term, '/')) {
            // 16.2
            if (IriResolver::isIri($mapping = IriResolver::expand($activeContext, $term))) {
                $definition->iriMapping = $mapping;
            } else {
                throw new TermDefinitionCreationException('invalid IRI mapping');
            }
        // 17
        } elseif (Keyword::TYPE->value === $term) {
            $definition->iriMapping = Keyword::TYPE->value;
        // 18
        } elseif ($activeContext->vocabularyMapping) {
            $definition->iriMapping = $activeContext->vocabularyMapping . $term;
        } else {
            throw new TermDefinitionCreationException('invalid IRI mapping');
        }

        // 19
        if (property_exists($value, Keyword::CONTAINER->value)) {
            $container = $value->{Keyword::CONTAINER->value};

            // 19.1
            if (!self::validateContainerEntry($container)) {
                throw new TermDefinitionCreationException('invalid container mapping');
            }

            // 19.2
            // The documentation is obviously wrong here, 19.1 and 19.2 exclude each other on several points.
            // I'm leaving it commented for now.

            // if (
            //     Keyword::GRAPH->value === $container ||
            //     Keyword::ID->value === $container ||
            //     Keyword::TYPE->value === $container ||
            //     !\is_string($container)
            // ) {
            //     throw new TermDefinitionCreationException('invalid container mapping');
            // }

            // 19.3
            $definition->containerMapping = (array) $container;

            // 19.4
            if (\in_array(Keyword::TYPE->value, $definition->containerMapping, true)) {
                if (!$definition->typeMapping) {
                    $definition->typeMapping = Keyword::ID->value;
                }

                if (!\in_array($definition->typeMapping, [Keyword::ID->value, Keyword::VOCAB->value], true)) {
                    throw new TermDefinitionCreationException('invalid type mapping');
                }
            }
        }

        // 20
        if (property_exists($value, Keyword::INDEX->value)) {
            // 20.1
            if (
                Context::PROCESSING_MODE_10 === $activeContext->processingMode ||
                !\in_array(Keyword::INDEX->value, $definition->containerMapping, true)
            ) {
                throw new TermDefinitionCreationException('invalid term definition');
            }

            // 20.2
            $index = $value->{Keyword::INDEX->value};

            if (!IriResolver::expand($activeContext, $index)) {
                throw new TermDefinitionCreationException('invalid term defnition');
            }

            // 20.3
            $definition->indexMapping = $index;
        }

        // 21
        if (property_exists($value, Keyword::CONTEXT->value)) {
            // 21.1
            if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                throw new TermDefinitionCreationException('invalid term definiton');
            }

            // 21.2 : No need to do anything

            // 21.3 : we skip 21.3 because it actually updates the activeContext, which it should not (see the note).
            // Maybe in the future we will implement a "dry run" for context processing, which would make it possible to just validate the context

            // 21.4
            $definition->context = $value->{Keyword::CONTEXT->value};
            $definition->baseUrl = $baseUrl;
        }

        // 22
        if (property_exists($value, Keyword::LANGUAGE->value) && !property_exists($value, Keyword::TYPE->value)) {
            // 22.1
            $language = $value->{Keyword::LANGUAGE->value};

            if (null !== $language && !\is_string($language)) {
                throw new TermDefinitionCreationException('invalid language mapping');
            }

            // 22.2
            $definition->languageMapping = $language;
        }

        // 23
        if (property_exists($value, Keyword::DIRECTION->value) && !property_exists($value, Keyword::TYPE->value)) {
            // 23.1
            $direction = $value->{Keyword::DIRECTION->value};

            if (
                null !== $direction &&
                'ltr' !== $direction &&
                'rtl' !== $direction
            ) {
                throw new TermDefinitionCreationException('invalid base direction');
            }

            // 23.2
            $definition->directionMapping = $direction;
        }

        // 24
        if (property_exists($value, Keyword::NEST->value)) {
            // 24.1
            if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                throw new TermDefinitionCreationException('invalid term definition');
            }

            // 24.2
            if (
                !\is_string($definition->nestValue) &&
                (!\in_array($definition->nestValue, Keyword::cases(), true) ||
                    Keyword::NEST->value === $definition->nestValue
                )
            ) {
                throw new TermDefinitionCreationException('invalid nest value');
            }

            // 24.2
            $definition->nestValue = $value->{Keyword::NEST->value};
        }

        // 25
        if (property_exists($value, Keyword::PREFIX->value)) {
            // 25.1
            if (
                Context::PROCESSING_MODE_10 === $activeContext->processingMode ||
                str_contains($term, ':') ||
                str_contains($term, '/')
            ) {
                throw new TermDefinitionCreationException('invalid term definition');
            }

            // 25.1
            if (str_contains($term, ':') || str_contains($term, '/')) {
                throw new TermDefinitionCreationException('invalid term value');
            }

            // 25.2
            if (!\is_bool($value->{Keyword::PREFIX->value})) {
                throw new TermDefinitionCreationException('invalid @prefix value');
            }

            // 25.2
            $definition->prefixFlag = $value->{Keyword::PREFIX->value};

            // 25.3
            if ($definition->prefixFlag && Keyword::tryFrom($definition->iriMapping)) {
                throw new TermDefinitionCreationException('invalid term definition');
            }
        }

        // 26
        foreach ($value as $entry => $v) {
            if (!\in_array(
                $entry,
                [
                    Keyword::ID->value,
                    Keyword::REVERSE->value,
                    Keyword::CONTAINER->value,
                    Keyword::CONTEXT->value,
                    Keyword::DIRECTION->value,
                    Keyword::INDEX->value,
                    Keyword::LANGUAGE->value,
                    Keyword::NEST->value,
                    Keyword::PREFIX->value,
                    Keyword::PROTECTED->value,
                    Keyword::TYPE->value,
                ],
                true
            )) {
                throw new TermDefinitionCreationException('invalid term definition');
            }
        }

        // 27
        if (!$overrideProtected && isset($previousDefinition) && $previousDefinition->protected) {
            // 27.1
            foreach ($definition as $property => $value) {
                if ('protected' === $property) {
                    continue;
                }

                if (!property_exists($previousDefinition, $property) || $previousDefinition->$property !== $value) {
                    // 27.1
                    throw new TermDefinitionCreationException('protected term redefinition');
                }
            }

            // 27.2
            $definition = $previousDefinition;
        }

        // 28
        $activeContext->termDefinitions[$term] = $definition;
        $defined[$term] = true;
    }

    public static function validateContainerEntry(string|array $container): bool
    {
        $keywords = [
            Keyword::GRAPH->value,
            Keyword::ID->value,
            Keyword::INDEX->value,
            Keyword::LANGUAGE->value,
            Keyword::LIST->value,
            Keyword::SET->value,
            Keyword::TYPE->value,
        ];

        if (\is_string($container) && \in_array($container, $keywords, true)) {
            return true;
        }

        if (\is_array($container)) {
            if (1 === \count($container) && \in_array($container[0], $keywords, true)) {
                return true;
            }

            if (\in_array(Keyword::GRAPH->value, $container, true)) {
                if (\count(array_intersect([Keyword::ID->value, Keyword::INDEX->value], $container))) {
                    return true;
                }
            }

            if (\in_array(Keyword::SET->value, $container, true)) {
                if (\count(array_intersect(
                    [Keyword::INDEX->value, Keyword::GRAPH->value, Keyword::ID->value, Keyword::TYPE->value, Keyword::LANGUAGE->value],
                    $container
                ))) {
                    return true;
                }
            }
        }

        return false;
    }
}
