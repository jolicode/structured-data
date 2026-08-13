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
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\TermDefinitionCreationException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;

/**
 * Steps 13 to 16 of the Create Term Definition algorithm: everything that resolves
 * the IRI mapping of a term definition.
 *
 * see https://www.w3.org/TR/json-ld-api/#create-term-definition
 */
final class TermIriMappingResolver
{
    /**
     * This method should interrupt the process if the term should be ignored.
     */
    public static function setReverseDefinition(
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

    public static function handleIdValue(
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

    public static function hasNonTerminalPrefixSeparator(string $value): bool
    {
        $position = strpos($value, ':');

        return false !== $position
            && 0 !== $position
            && $position < \strlen($value) - 1
            && '^' !== $value[$position - 1]
            && '$' !== $value[$position + 1];
    }

    public static function handleTermWithColons(
        Context $activeContext,
        TermDefinitionDraft $definition,
        \stdClass $localContext,
        string $term,
        array $defined,
    ): void {
        [$prefix, $suffix] = explode(':', $term, 2);

        // 15.1
        if (property_exists($localContext, $suffix)) {
            TermDefinitionCreator::create($activeContext, $localContext, $prefix, $defined);
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
}
