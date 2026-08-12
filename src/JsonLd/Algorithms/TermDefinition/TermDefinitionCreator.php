<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextCache;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\ContextProcessor;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ContextProcessingException;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\TermDefinitionCreationException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\Services\DataStructureComparator;

class TermDefinitionCreator
{
    private const ALLOWED_TERM_DEFINITION_ENTRIES = [
        '@id' => true,
        '@reverse' => true,
        '@container' => true,
        '@context' => true,
        '@direction' => true,
        '@index' => true,
        '@language' => true,
        '@nest' => true,
        '@prefix' => true,
        '@protected' => true,
        '@type' => true,
    ];

    /**
     * This is a PHP implementation of the Create Term Definition based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * see https://www.w3.org/TR/json-ld-api/#create-term-definition
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
        ?ContextCache $cache = null,
    ): void {
        $simpleTerm = false;
        $termHasSlash = str_contains($term, '/');
        $termHasNonTerminalPrefixSeparator = self::hasNonTerminalPrefixSeparator($term);
        $termNeedsExpandedMappingConsistencyCheck = $termHasSlash || $termHasNonTerminalPrefixSeparator;

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

            if (IriResolver::isKeywordLikeString($term)) {
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
            if (!$value instanceof \stdClass) {
                throw new TermDefinitionCreationException('invalid term definition');
            }

            $simpleTerm = false;
        }

        // 10
        $definition = new TermDefinitionDraft(false, $protected, false);

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
            $shouldReturn = self::handleIdValue(
                $activeContext,
                $definition,
                $term,
                $value,
                $localContext,
                $defined,
                $simpleTerm,
                $termNeedsExpandedMappingConsistencyCheck,
            );

            if ($shouldReturn) {
                return;
            }
        // 15
        } elseif ($termHasNonTerminalPrefixSeparator) {
            self::handleTermWithColons($activeContext, $definition, $localContext, $term, $defined);
        // 16
        } elseif ($termHasSlash) {
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
            self::handleContextValue($activeContext, $value, $definition, $value, $baseUrl, $remoteContexts, $cache);
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
        foreach ($value as $entry => $_value) {
            if (!isset(self::ALLOWED_TERM_DEFINITION_ENTRIES[$entry])) {
                throw new TermDefinitionCreationException('invalid term definition');
            }
        }

        // 27
        if (!$overrideProtected && isset($previousDefinition) && $previousDefinition->protected) {
            $definition = self::switchToPreviousDefinition($definition, $previousDefinition);
        }

        // 28
        $activeContext->termDefinitions[$term] = $definition instanceof TermDefinition ? $definition : $definition->toTermDefinition();
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
        TermDefinitionDraft $definition,
        \stdClass $localContext,
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
        TermDefinitionDraft $definition,
        \stdClass $localContext,
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
        if (IriResolver::isKeywordLikeString($value->{Keyword::REVERSE->value})) {
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
        $activeContext->termDefinitions[$term] = $definition->toTermDefinition();
        $defined[$term] = true;

        return false;
    }

    private static function handleIdValue(
        Context $activeContext,
        TermDefinitionDraft $definition,
        string $term,
        mixed $value,
        \stdClass $localContext,
        array $defined,
        bool $simpleTerm,
        bool $termNeedsExpandedMappingConsistencyCheck,
    ): bool {
        // 14.1
        $id = $value->{Keyword::ID->value};

        // 14.2
        if (null !== $id) {
            // 14.2.1
            if (!\is_string($id)) {
                throw new TermDefinitionCreationException('invalid IRI mapping');
            }

            if (!Keyword::tryFrom($id) && IriResolver::isKeywordLikeString($id)) {
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
                null !== $definition->iriMapping
                && !Keyword::tryFrom($definition->iriMapping)
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
                Context::PROCESSING_MODE_11 === $activeContext->processingMode
                && $termNeedsExpandedMappingConsistencyCheck
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
            // Only simple (string-valued) terms get the prefix flag. In JSON-LD 1.0,
            // IRI expansion treats any defined term as a prefix regardless of this
            // flag - that case is handled in the IRI Expansion algorithm itself, so
            // that compaction (which only produces compact IRIs from prefix terms)
            // keeps an accurate flag.
            if (
                !str_contains($term, ':')
                && !str_contains($term, '/')
                && $simpleTerm
                && null !== $definition->iriMapping
            ) {
                if (IriResolver::iriMappingActsAsPrefix($definition->iriMapping)) {
                    $definition->prefixFlag = true;
                }
            }
        }

        return false;
    }

    private static function hasNonTerminalPrefixSeparator(string $value): bool
    {
        $position = strpos($value, ':');

        return false !== $position
            && 0 !== $position
            && $position < \strlen($value) - 1
            && '^' !== $value[$position - 1]
            && '$' !== $value[$position + 1];
    }

    private static function handleTermWithColons(
        Context $activeContext,
        TermDefinitionDraft $definition,
        \stdClass $localContext,
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
        TermDefinitionDraft $definition,
        mixed $value,
    ): void {
        $container = $value->{Keyword::CONTAINER->value};

        // 19.1
        if (!self::validateContainerEntry($container)) {
            throw new TermDefinitionCreationException('invalid container mapping');
        }

        // 19.2
        if (
            Context::PROCESSING_MODE_10 === $activeContext->processingMode
            && \is_array($container)
        ) {
            throw new TermDefinitionCreationException('invalid container mapping');
        }

        // 19.3
        if (
            \in_array($container, [Keyword::GRAPH->value, Keyword::ID->value, Keyword::TYPE->value], true)
            && Context::PROCESSING_MODE_10 === $activeContext->processingMode
        ) {
            throw new TermDefinitionCreationException('invalid container mapping');
        }

        // 19.4
        $definition->containerMapping = (array) $container;

        // 19.5
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
        TermDefinitionDraft $definition,
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
        \stdClass $localContext,
        TermDefinitionDraft $definition,
        mixed $value,
        ?string $baseUrl,
        array &$remoteContexts,
        ?ContextCache $cache = null,
    ): void {
        // 21.1
        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        // 21.2
        $context = $localContext->{Keyword::CONTEXT->value};
        $processer = new ContextProcessor($cache ?? new ContextCache());

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
        TermDefinitionDraft $definition,
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
        TermDefinitionDraft $definition,
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
        TermDefinitionDraft $definition,
        mixed $value,
    ): void {
        // 24.1
        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
            throw new TermDefinitionCreationException('invalid term definition');
        }

        // 24.2
        $nestValue = $value->{Keyword::NEST->value};

        if (!\is_string($nestValue) || (null !== Keyword::tryFrom($nestValue) && Keyword::NEST !== Keyword::tryFrom($nestValue))) {
            throw new TermDefinitionCreationException('invalid @nest value');
        }

        // 24.2
        $definition->nestValue = $nestValue;
    }

    private static function setPrefixFlag(
        Context $activeContext,
        TermDefinitionDraft $definition,
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
        if ($definition->prefixFlag && null !== $definition->iriMapping && Keyword::tryFrom($definition->iriMapping)) {
            throw new TermDefinitionCreationException('invalid term definition');
        }
    }

    private static function switchToPreviousDefinition(
        TermDefinitionDraft $definition,
        TermDefinition $previousDefinition,
    ): TermDefinition {
        // 27.1
        if (!DataStructureComparator::objectsHaveSameProperties($previousDefinition, $definition->toTermDefinition(), 'protected')) {
            throw new TermDefinitionCreationException('protected term redefinition');
        }

        // 27.2
        return $previousDefinition;
    }
}
