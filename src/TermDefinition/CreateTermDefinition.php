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
use Jolicode\JsonLd\ContextProcessing\ContextProcesser;
use Jolicode\JsonLd\Http\IriResolver;
use Jolicode\JsonLd\JsonLd\Keyword;

class CreateTermDefinition
{
    /**
     * Implementation of the W3C Create Term Definition algorithm : https://www.w3.org/TR/json-ld-api/#create-term-definition
     * It is based on the 16th July 2020 recommendation.
     */
    public static function create(
        Context $activeContext,
        \stdClass $localContext,
        string $term,
        array $defined,
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

            // TODO: implement real exceptions and catch them.
            throw new \Exception('cyclic IRI mapping error');
        }

        // 2
        if ('' === $term) {
            // TODO: implement real exceptions and catch them.
            throw new \Exception('invalid term definition');
        }
        $defined[$term] = false;

        // 3
        $value = $localContext->$term;

        // TODO: 4

        // 5
        if (preg_match('/^@\w+/', $term)) {
            // TODO: use a logger
            dump('WARNING: a value has the form of a keyword. Skipping. Value is : ' . $term);

            return;
        }

        // 6
        if (\array_key_exists($term, $activeContext->options->termDefinitions)) {
            $previousDefinition = $activeContext->options->termDefinitions[$term];
            unset($activeContext->options->termDefinitions[$term]);
        }

        // 7
        if (null === $value) {
            $value = (object) [Keyword::ID->value => null];
        // 8
        } elseif (\is_string($value)) {
            $value = (object) [Keyword::ID->value => $value];
            $simpleTerm = true;
        // 9
        } elseif (!\is_object($value)) {
            // TODO: implement real exceptions and catch them.
            throw new \Exception('invalid term definition');
        } else {
            $simpleTerm = false;
        }

        // 10
        $definition = new TermDefinition(false, $protected, false);

        // 11
        if (property_exists($value, Keyword::PROTECTED->value)) {
            if ('boolean' !== \gettype($value)) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid @protected value');
            }

            $definition->protected = $value->{Keyword::PROTECTED->value};
        }

        // 12
        if (property_exists($value, Keyword::TYPE->value)) {
            // 12.1
            if (!\is_string($value->{Keyword::TYPE->value})) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid @protected value');
            }

            // 12.1
            $type = $value->{Keyword::TYPE->value};
            // 12.2
            $type = IriResolver::expand($activeContext, $type, localContext: $localContext, defined: $defined);

            // TODO: 12.3

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
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid type mapping');
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
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid reverse property');
            }

            // 13.2
            if (!\is_string($value->{Keyword::REVERSE->value})) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid IRI mapping');
            }

            // 13.3
            if (preg_match('/^@\w+/', $value->{Keyword::REVERSE->value})) {
                // TODO: use a logger
                dump('WARNING: a value has the form of a keyword. Skipping. Value is : ' . $term);

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
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid IRI mapping');
            }

            // 13.5
            if (property_exists($value, Keyword::CONTAINER->value)) {
                if (
                    null !== $value->{Keyword::CONTAINER->value} &&
                    $value->{Keyword::CONTAINER->value} !== Keyword::SET->value &&
                    $value->{Keyword::CONTAINER->value} !== Keyword::INDEX->value
                ) {
                    // TODO: implement real exceptions and catch them.
                    throw new \Exception('invalid reverse property');
                }

                $definition->containerMapping = [$value->{Keyword::CONTAINER->value}];
            }

            // 13.6
            $definition->reverseProperty = true;
            // 13.7
            $activeContext->options->termDefinitions[$term] = $definition;
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
                    // TODO: implement real exceptions and catch them.
                    throw new \Exception('invalid IRI mapping');
                }

                if (!Keyword::tryFrom($id) && preg_match('/^@\w+/', $id)) {
                    // TODO: use a logger
                    dump('WARNING: a value has the form of a keyword. Skipping. Value is : ' . $term);

                    return;
                }

                $definition->iriMapping = IriResolver::expand(
                    $activeContext,
                    $value->{Keyword::ID->value},
                    defined: $defined,
                    localContext: $localContext
                );

                if (
                    !Keyword::tryFrom($definition->iriMapping) &&
                    !IriResolver::isAbsoluteIriOrBlankNode($definition->iriMapping)
                ) {
                    // TODO: implement real exceptions and catch them.
                    throw new \Exception('invalid IRI mapping');
                }

                if ($definition->iriMapping === Keyword::CONTEXT->value) {
                    // TODO: implement real exceptions and catch them.
                    throw new \Exception('invalid keyword alias');
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
                        // TODO: implement real exceptions and catch them.
                        throw new \Exception('invalid IRI mapping');
                    }
                }

                if (!str_contains(':', $term) && !str_contains('/', $term)) {
                    $simpleTerm = true;
                }

                if (
                    str_starts_with('_:', $definition->iriMapping) ||
                    (\in_array($definition->iriMapping[\strlen($definition->iriMapping) - 1], [':', ',', '?', '#', '[', ']', '@'], true) &&
                        IriResolver::isIri($definition->iriMapping)
                    )
                ) {
                    $definition->prefixFlag = true;
                }
            }
        // 15
        } elseif (preg_match('/[^^]:/', $term)) {
            [$prefix, $suffix] = explode(':', $term, 2);

            // 15.1
            if (property_exists($localContext, $suffix)) {
                self::create($activeContext, $localContext, $prefix, $defined);
            }

            // 15.2
            if (\array_key_exists($prefix, $activeContext->options->termDefinitions)) {
                // Not sure here, doc is not very clear. Will probably need to look at it again.
                $definition->iriMapping = $activeContext
                    ->options
                    ->termDefinitions[$prefix]
                    ->iriMapping . $suffix;
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
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid IRI mapping');
            }
        // 17
        } elseif (Keyword::TYPE->value === $term) {
            $definition->iriMapping = Keyword::TYPE->value;
        // 18
        } elseif ($activeContext->options->vocabularyMapping) {
            $definition->iriMapping = $activeContext->options->vocabularyMapping . $term;
        }

        // 19
        if (property_exists($value, Keyword::CONTAINER->value)) {
            $container = $value->{Keyword::CONTAINER->value};
            // 19.1
            if (!self::validateContainerEntry($container)) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid container mapping');
            }

            // 19.2
            // Might need to double check the &&
            if (
                \in_array($container, [Keyword::GRAPH->value, Keyword::ID->value, Keyword::TYPE->value], true) ||
                !\is_string($container)
            ) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid container mapping');
            }

            // 19.3
            $definition->containerMapping = (array) $container;

            // 19.4
            if (\array_key_exists(Keyword::TYPE->value, $definition->containerMapping)) {
                if (!$definition->typeMapping) {
                    $definition->typeMapping = Keyword::ID->value;
                }

                if (!\in_array($definition->typeMapping, [Keyword::ID->value, Keyword::VOCAB->value], true)) {
                    // TODO: implement real exceptions and catch them.
                    throw new \Exception('invalid type mapping');
                }
            }
        }

        // 20
        if (property_exists($value, Keyword::INDEX->value)) {
            // 20.1
            // TODO: json-ld-1.0 processing mode stuff

            // 20.2
            $index = $value->{Keyword::INDEX};

            if (!IriResolver::expand($activeContext, $index)) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid term defnition');
            }

            // 20.3
            $definition->indexMapping = $index;
        }

        // 21
        if (property_exists($value, Keyword::CONTEXT->value)) {
            // 21.1
            // TODO: json-ld-1.0 processing mode stuff

            // 21.2
            $context = $value->{Keyword::CONTEXT->value};
            $nextContext = new Context($context);
            // 21.3
            try {
                $contextProcesser = new ContextProcesser();
                $contextProcesser->processContext(
                    $activeContext,
                    $nextContext,
                    $baseUrl,
                    $remoteContexts,
                    true,
                    validateScopedContext: false
                );
            } catch (\Exception) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid scoped context');
            }

            // Does not exist in our class but the doc says to set it.
            // Needs further investigation
            // 21.4
            $definition->localContext = $context;
            $definition->baseUrl = $baseUrl;
        }

        // 22
        if (property_exists($value, Keyword::LANGUAGE->value) && !property_exists($value, Keyword::TYPE->value)) {
            // 22.1
            $language = $value->{Keyword::LANGUAGE->value};

            if (null !== $language || !\is_string($language)) {
                // TODO: Ass the language check
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid language mapping');
            }

            // 22.2
            $definition->languageMapping = $language;
        }

        // 23
        if (property_exists($value, Keyword::DIRECTION->value) && !property_exists($value, Keyword::TYPE->value)) {
            // 23.1
            $direction = $value->{Keyword::DIRECTION->value};

            if (
                null !== $direction ||
                'ltr' !== $direction ||
                'rtl' !== $direction
            ) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid base direction');
            }

            // 23.2
            $definition->directionMapping = $direction;
        }

        // 24
        if (property_exists($value, Keyword::NEST->value)) {
            // 24.1
            // TODO: json-ld-1.0 processing mode stuff

            // 24.2
            if (
                !\is_string($definition->nestValue) &&
                (!\in_array($definition->nestValue, Keyword::cases(), true) ||
                    Keyword::NEST->value === $definition->nestValue
                )
            ) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid nest value');
            }

            // 24.2
            $definition->nestValue = $value->{Keyword::NEST->value};
        }

        // 25
        if (property_exists($value, Keyword::PREFIX->value)) {
            // 25.1
            // TODO: json-ld-1.0 processing mode stuff

            // 25.1
            if (str_contains($term, ':') || str_contains($term, '/')) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid term value');
            }

            // 25.2
            if (!\is_bool($value->{Keyword::PREFIX->value})) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid @prefix value');
            }

            // 25.2
            $definition->prefixFlag = $value->{Keyword::PREFIX->value};

            // 25.3
            if ($definition->prefixFlag && Keyword::tryFrom($definition->iriMapping)) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('invalid term definition');
            }
        }

        // 26 is a bit painful, will do later

        // 27
        if (!$overrideProtected && isset($previousDefinition) && $previousDefinition->protected) {
            // 27.1
            // TODO: Double check the ===
            if (
                $definition !== $previousDefinition &&
                $definition->protected === $previousDefinition->protected
            ) {
                // TODO: implement real exceptions and catch them.
                throw new \Exception('protected term redefinition');
            }

            // 27.2
            $definition = $previousDefinition;
        }

        // 28
        $activeContext->options->termDefinitions[$term] = $definition;
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
