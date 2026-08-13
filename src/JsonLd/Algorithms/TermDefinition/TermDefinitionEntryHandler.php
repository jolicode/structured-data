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

/**
 * Steps 19 to 25 of the Create Term Definition algorithm: one handler per term
 * definition entry, each mutating the definition draft it is given.
 *
 * see https://www.w3.org/TR/json-ld-api/#create-term-definition
 */
final class TermDefinitionEntryHandler
{
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

    public static function handleContainerValue(
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

    public static function handleIndexValue(
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

    public static function handleContextValue(
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

    public static function handleLanguageValue(
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

    public static function handleDirectionValue(
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

    public static function handleNestValue(
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

    public static function setPrefixFlag(
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
}
