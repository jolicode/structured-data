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
        $termHasNonTerminalPrefixSeparator = TermIriMappingResolver::hasNonTerminalPrefixSeparator($term);
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
            if ($mustIgnoreTerm = TermIriMappingResolver::setReverseDefinition($activeContext, $definition, $localContext, $term, $value, $defined)) {
                return;
            }
        // 14
        } elseif (
            property_exists($value, Keyword::ID->value)
            && $value->{Keyword::ID->value} !== $term
        ) {
            $shouldReturn = TermIriMappingResolver::handleIdValue(
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
            TermIriMappingResolver::handleTermWithColons($activeContext, $definition, $localContext, $term, $defined);
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
            TermDefinitionEntryHandler::handleContainerValue($activeContext, $definition, $value);
        }

        // 20
        if (property_exists($value, Keyword::INDEX->value)) {
            TermDefinitionEntryHandler::handleIndexValue($activeContext, $definition, $value);
        }

        // 21
        if (property_exists($value, Keyword::CONTEXT->value)) {
            TermDefinitionEntryHandler::handleContextValue($activeContext, $value, $definition, $value, $baseUrl, $remoteContexts, $cache);
        }

        // 22
        if (property_exists($value, Keyword::LANGUAGE->value) && !property_exists($value, Keyword::TYPE->value)) {
            TermDefinitionEntryHandler::handleLanguageValue($definition, $value);
        }

        // 23
        if (property_exists($value, Keyword::DIRECTION->value) && !property_exists($value, Keyword::TYPE->value)) {
            TermDefinitionEntryHandler::handleDirectionValue($definition, $value);
        }

        // 24
        if (property_exists($value, Keyword::NEST->value)) {
            TermDefinitionEntryHandler::handleNestValue($activeContext, $definition, $value);
        }

        // 25
        if (property_exists($value, Keyword::PREFIX->value)) {
            TermDefinitionEntryHandler::setPrefixFlag($activeContext, $definition, $term, $value);
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
