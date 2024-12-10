<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\TermDefinition;

use Jolicode\JsonLd\Algorithms\ContextProcessing\Context;
use Jolicode\JsonLd\Algorithms\ContextProcessing\ContextProcesser;
use Jolicode\JsonLd\Algorithms\Exception\ContextProcessingException;
use Jolicode\JsonLd\Algorithms\Exception\TermDefinitionCreationException;
use Jolicode\JsonLd\Algorithms\Http\IriResolver;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Algorithms\Services\DataStructureComparator;

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
        array &$remoteContexts = [],
    ) {
        // 1
        if (\array_key_exists($term, $defined)) {
            if ($defined[$term]) {
                return;
            }

            throw new TermDefinitionCreationException('cyclic IRI mapping');
        }

        // 2
        if ('' === $term) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        $defined[$term] = false;

        // 3
        $value = $localContext->$term;

        // 4
        if (Keyword::TYPE->value === $term) {
            if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                throw new TermDefinitionCreationException('keyword redefinition');
            }

            if (!self::validateTypeValue($value)) {
                throw new TermDefinitionCreationException('keyword redefinition');
            }
        } else {
            // 5
            if (Keyword::CONTEXT->value === $term) {
                throw new TermDefinitionCreationException('keyword redefinition');
            }

            if (preg_match('/^@[a-zA-Z]+$/', $term)) {
                return;
            }
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
            self::setTypeMapping($activeContext, $definition, $localContext, $value, $defined);
        }

        // 13
        if (property_exists($value, Keyword::REVERSE->value)) {
            if ($mustIgnoreTerm = self::setReverseDefinition($activeContext, $definition, $localContext, $term, $value, $defined)) {
                return;
            }
        // 14
        } elseif (
            property_exists($value, Keyword::ID->value)
            && $value->{Keyword::ID->value} !== $term
        ) {
            $shouldReturn = self::handleIdValue($activeContext, $definition, $term, $value, $localContext, $defined, isset($simpleTerm) ? $simpleTerm : false);

            if ($shouldReturn) {
                return;
            }
        // 15
        } elseif (preg_match('/[^^]:/', $term)) {
            self::handleTermWithColons($activeContext, $definition, $localContext, $term, $defined);
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
            self::handleContainerValue($activeContext, $definition, $value);
        }

        // 20
        if (property_exists($value, Keyword::INDEX->value)) {
            self::handleIndexValue($activeContext, $definition, $value);
        }

        // 21
        if (property_exists($value, Keyword::CONTEXT->value)) {
            self::handleContextValue($activeContext, $value, $definition, $value, $baseUrl, $remoteContexts);
        }

        // 22
        if (property_exists($value, Keyword::LANGUAGE->value) && !property_exists($value, Keyword::TYPE->value)) {
            self::handleLanguageValue($definition, $value);
        }

        // 23
        if (property_exists($value, Keyword::DIRECTION->value) && !property_exists($value, Keyword::TYPE->value)) {
            self::handleDirectionValue($definition, $value);
        }

        // 24
        if (property_exists($value, Keyword::NEST->value)) {
            self::handleNestValue($activeContext, $definition, $value);
        }

        // 25
        if (property_exists($value, Keyword::PREFIX->value)) {
            self::setPrefixFlag($activeContext, $definition, $term, $value);
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
                true,
            )) {
                throw new TermDefinitionCreationException('invalid term definition');
            }
        }

        // 27
        if (!$overrideProtected && isset($previousDefinition) && $previousDefinition->protected) {
            self::switchToPreviousDefinition($definition, $previousDefinition);
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
                    $container,
                ))) {
                    return true;
                }
            }
        }

        return false;
    }

    private static function validateTypeValue(mixed $value): bool
    {
        if (\is_object($value) && \count(get_object_vars($value)) < 3) {
            if (property_exists($value, Keyword::PROTECTED->value)) {
                return true;
            }

            if (
                property_exists($value, Keyword::CONTAINER->value)
                && $value->{Keyword::CONTAINER->value} === Keyword::SET->value
            ) {
                return true;
            }
        }

        return false;
    }

    private static function setTypeMapping(
        Context $activeContext,
        TermDefinition $definition,
        \stdClass|array $localContext,
        mixed $value,
        array $defined,
    ): void {
        // 12.1
        if (!\is_string($type = $value->{Keyword::TYPE->value})) {
            throw new TermDefinitionCreationException('invalid type mapping');
        }

        // 12.2
        $type = IriResolver::expand($activeContext, $type, localContext: $localContext, defined: $defined);

        // 12.3
        if (
            Context::PROCESSING_MODE_10 === $activeContext->processingMode
            && \in_array($type, [Keyword::JSON->value, Keyword::NONE->value], true)
        ) {
            throw new TermDefinitionCreationException('invalid type mapping');
        }

        // 12.4
        if (
            // Specs write Iri but tests manifest write absolute Iri
            !IriResolver::isAbsoluteIri($type)
            && !\in_array(
                $type,
                [
                    Keyword::ID->value, Keyword::NONE->value, Keyword::JSON->value, Keyword::VOCAB->value,
                ],
                true,
            )
        ) {
            throw new TermDefinitionCreationException('invalid type mapping');
        }

        // 12.5
        $definition->typeMapping = $type;
    }

    /**
     * This method should interrupt the process if the term should be ignored.
     */
    private static function setReverseDefinition(
        Context $activeContext,
        TermDefinition $definition,
        \stdClass|array $localContext,
        string $term,
        mixed $value,
        array $defined,
    ): bool {
        // 13.1
        if (
            property_exists($value, Keyword::ID->value)
            || property_exists($value, Keyword::NEST->value)
        ) {
            throw new TermDefinitionCreationException('invalid reverse property');
        }

        // 13.2
        if (!\is_string($value->{Keyword::REVERSE->value})) {
            throw new TermDefinitionCreationException('invalid IRI mapping');
        }

        // 13.3
        if (preg_match('/^@[a-zA-Z]+$/', $value->{Keyword::REVERSE->value})) {
            return true;
        }

        // 13.4
        $definition->iriMapping = IriResolver::expand(
            $activeContext,
            $value->{Keyword::REVERSE->value},
            defined: $defined,
            localContext: $localContext,
        );

        // 13.4
        if (!IriResolver::isAbsoluteIriOrBlankNode($definition->iriMapping)) {
            throw new TermDefinitionCreationException('invalid IRI mapping');
        }

        // 13.5
        if (property_exists($value, Keyword::CONTAINER->value)) {
            if (
                null !== $value->{Keyword::CONTAINER->value}
                && $value->{Keyword::CONTAINER->value} !== Keyword::SET->value
                && $value->{Keyword::CONTAINER->value} !== Keyword::INDEX->value
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

        return false;
    }

    private static function handleIdValue(
        Context $activeContext,
        TermDefinition $definition,
        string $term,
        mixed $value,
        \stdClass|array $localContext,
        array $defined,
        bool $simpleTerm,
    ): bool {
        // 14.1
        $id = $value->{Keyword::ID->value};

        // 14.2
        if (null !== $id) {
            // 14.2.1
            if (!\is_string($id)) {
                throw new TermDefinitionCreationException('invalid IRI mapping');
            }

            if (!Keyword::tryFrom($id) && preg_match('/^@[a-zA-Z]+$/', $id)) {
                return true;
            }

            // 14.2.3
            $definition->iriMapping = IriResolver::expand(
                $activeContext,
                $id,
                defined: $defined,
                localContext: $localContext,
            );

            if (
                !Keyword::tryFrom($definition->iriMapping)
                && !IriResolver::isIri($definition->iriMapping)
                && !IriResolver::isBlankNodeIdentifier($definition->iriMapping)
            ) {
                throw new TermDefinitionCreationException('invalid IRI mapping');
            }

            if ($definition->iriMapping === Keyword::CONTEXT->value) {
                throw new TermDefinitionCreationException('invalid keyword alias');
            }

            // 14.2.4
            if (
                str_contains($term, '/')
                || preg_match('/[^^]:[^$]/', $term)
            ) {
                // 14.2.4.1
                $defined[$term] = true;

                // 14.2.4.2
                if (
                    IriResolver::expand(
                        $activeContext,
                        $term,
                        defined: $defined,
                        localContext: $localContext,
                    ) !== $definition->iriMapping
                ) {
                    throw new TermDefinitionCreationException('invalid IRI mapping');
                }
            }

            // 14.2.5
            if (
                !str_contains(':', $term)
                && !str_contains('/', $term)
                && $simpleTerm
            ) {
                $lastChar = mb_substr($definition->iriMapping, -1);
                $genDelimCharacters = [':', '/', '?', '#', '[', ']', '@'];

                if (IriResolver::isBlankNodeIdentifier($definition->iriMapping) || \in_array($lastChar, $genDelimCharacters, true)) {
                    $definition->prefixFlag = true;
                }
            }
        }

        return false;
    }

    private static function handleTermWithColons(
        Context $activeContext,
        TermDefinition $definition,
        \stdClass|array $localContext,
        string $term,
        array $defined,
    ): void {
        [$prefix, $suffix] = explode(':', $term, 2);

        // 15.1
        if (property_exists($localContext, $suffix)) {
            self::create($activeContext, $localContext, $prefix, $defined);
        }

        /** @var TermDefinition[] $activeDefinitions */
        $activeDefinitions = $activeContext->termDefinitions;

        // 15.2
        if (\array_key_exists($prefix, $activeContext->termDefinitions)) {
            $definition->iriMapping = $activeDefinitions[$prefix]->iriMapping . $suffix;
        // 15.3
        } else {
            $definition->iriMapping = $term;
        }
    }

    private static function handleContainerValue(
        Context $activeContext,
        TermDefinition $definition,
        mixed $value,
    ) {
        $container = $value->{Keyword::CONTAINER->value};

        // 19.1
        if (!self::validateContainerEntry($container)) {
            throw new TermDefinitionCreationException('invalid container mapping');
        }

        // 19.2
        if (
            \in_array($container, [Keyword::GRAPH->value, Keyword::ID->value, Keyword::TYPE->value], true)
            && Context::PROCESSING_MODE_10 === $activeContext->processingMode
        ) {
            throw new TermDefinitionCreationException('invalid container mapping');
        }

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

    private static function handleIndexValue(
        Context $activeContext,
        TermDefinition $definition,
        mixed $value,
    ): void {
        // 20.1
        if (
            Context::PROCESSING_MODE_10 === $activeContext->processingMode
            || !$definition->containerMapping
            || !\in_array(Keyword::INDEX->value, $definition->containerMapping, true)
        ) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        // 20.2
        $index = $value->{Keyword::INDEX->value};

        // This is not in the specs but :
        //  - the pi03-in.jsonld explicitely say that an exception should be thrown if @index is a keyword
        //  - the pi04-in.jsonld explicitely say that an exception should be thrown if @index is not a string
        if (!\is_string($index) || Keyword::INDEX->value === $index) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        if (!IriResolver::isIri(IriResolver::expand($activeContext, $index))) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        // 20.3
        $definition->indexMapping = $index;
    }

    private static function handleContextValue(
        Context $activeContext,
        array|\stdClass $localContext,
        TermDefinition $definition,
        mixed $value,
        ?string $baseUrl,
        array &$remoteContexts,
    ): void {
        // 21.1
        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        // 21.2
        $context = $localContext->{Keyword::CONTEXT->value};
        $processer = new ContextProcesser();

        // 21.4
        // We swap 21.3 and 21.4 because the $activeContext needs the $baseUrl.
        $definition->context = $value->{Keyword::CONTEXT->value};
        $definition->baseUrl = $baseUrl;
        $activeContext->baseUrl = $baseUrl;

        // 21.3
        try {
            $processer->processContext(
                $activeContext,
                $context,
                $baseUrl,
                $remoteContexts,
                overrideProtected: true,
                validateScopedContext: false,
            );
        } catch (ContextProcessingException|TermDefinitionCreationException $exception) {
            throw new TermDefinitionCreationException('invalid scoped context');
        }
    }

    private static function handleLanguageValue(
        TermDefinition $definition,
        mixed $value,
    ): void {
        // 22.1
        $language = $value->{Keyword::LANGUAGE->value};

        if (null !== $language && !\is_string($language)) {
            throw new TermDefinitionCreationException('invalid language mapping');
        }

        // 22.2
        $definition->languageMapping = $language;
    }

    private static function handleDirectionValue(
        TermDefinition $definition,
        mixed $value,
    ): void {
        // 23.1
        $direction = $value->{Keyword::DIRECTION->value};

        if (
            null !== $direction
            && 'ltr' !== $direction
            && 'rtl' !== $direction
        ) {
            throw new TermDefinitionCreationException('invalid base direction');
        }

        // 23.2
        $definition->directionMapping = $direction;
    }

    private static function handleNestValue(
        Context $activeContext,
        TermDefinition $definition,
        mixed $value,
    ): void {
        // 24.1
        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        // 24.2
        if (
            !\is_string($definition->nestValue)
            && (!\in_array($definition->nestValue, Keyword::cases(), true)
                // || Keyword::NEST->value === $definition->nestValue
            )
        ) {
            throw new TermDefinitionCreationException('invalid @nest value');
        }

        // 24.2
        $definition->nestValue = $value->{Keyword::NEST->value};
    }

    private static function setPrefixFlag(
        Context $activeContext,
        TermDefinition $definition,
        string $term,
        mixed $value,
    ): void {
        // 25.1
        if (
            Context::PROCESSING_MODE_10 === $activeContext->processingMode
            || str_contains($term, ':')
            || str_contains($term, '/')
        ) {
            throw new TermDefinitionCreationException('invalid term definition');
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

    private static function switchToPreviousDefinition(
        TermDefinition &$definition,
        TermDefinition $previousDefinition,
    ): void {
        // 27.1
        if (!DataStructureComparator::objectsHaveSameProperties($previousDefinition, $definition, 'protected')) {
            throw new TermDefinitionCreationException('protected term redefinition');
        }

        // 27.2
        $definition = $previousDefinition;
    }
}
