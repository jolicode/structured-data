<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ContextProcessingException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\IriResolver;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
use JoliCode\StructuredData\JsonLd\Algorithms\TermDefinition\TermDefinitionCreator;

class ContextProcessor
{
    private const MAX_CONTEXTS = 10;

    public function __construct(
        private ContextCache $cache = new ContextCache(),
    ) {
    }

    public function parseJson(string $json): Context
    {
        $element = json_decode($json);

        return $this->processContext(new Context(), $this->extractContext($element));
    }

    /**
     * Takes a json decoded JSON-LD context as input and returns a processed context.
     *
     * This is a PHP implementation of the Context Processing algorithm based on the
     * JSON-LD 1.1 Processing Algorithms and API W3C Recommendation published on
     * July 16th, 2020.
     *
     * see https://www.w3.org/TR/json-ld-api/#context-processing-algorithms
     */
    public function processContext(
        Context $activeContext,
        mixed $localContext,
        ?string $baseUrl = null,
        array &$remoteContexts = [],
        bool $overrideProtected = false,
        bool $propagate = true,
        bool $validateScopedContext = true,
    ): Context {
        // 1
        $result = clone $activeContext;
        $result->inverseContext = null;

        // 2
        if (\is_object($localContext) && property_exists($localContext, Keyword::PROPAGATE->value)) {
            $propagate = $localContext->{Keyword::PROPAGATE->value};
        } elseif (\is_array($localContext) && \array_key_exists(Keyword::PROPAGATE->value, $localContext)) {
            $propagate = $localContext[Keyword::PROPAGATE->value];
        }

        // 3
        if (!$propagate && !$activeContext->previousContext) {
            $result->previousContext = $activeContext;
        }

        // 4
        if (!\is_array($localContext)) {
            $localContext = [$localContext];
        }

        if (!\count($localContext)) {
            return $activeContext;
        }

        // 5 && 6
        return $this->updateContext(
            $activeContext,
            $localContext,
            $result,
            $baseUrl,
            $remoteContexts,
            $overrideProtected,
            $propagate,
            $validateScopedContext,
        );
    }

    public function extractContext(\stdClass|array $json): mixed
    {
        if (\is_object($json) && property_exists($json, Keyword::CONTEXT->value)) {
            return $json->{Keyword::CONTEXT->value};
        }

        return null;
    }

    private function updateContext(
        Context $activeContext,
        array $localContext,
        Context $result,
        ?string $baseUrl = null,
        array &$remoteContexts = [],
        bool $overrideProtected = false,
        bool $propagate = true,
        bool $validateScopedContext = true,
    ): Context {
        foreach ($localContext as $context) {
            // 5.1
            if (null === $context) {
                ContextEntryHandler::handleNullContext($activeContext, $result, $overrideProtected, $propagate);

                // 5.1.3
                continue;
            }

            // 5.2
            if (\is_string($context)) {
                $this->handleStringContext($result, $context, $validateScopedContext, $remoteContexts);

                // 5.2.7
                continue;
            }

            // 5.3 & 5.4
            if (!$context instanceof \stdClass) {
                throw new ContextProcessingException('invalid local context');
            }

            // 5.5
            if (property_exists($context, Keyword::VERSION->value)) {
                ContextEntryHandler::handleVersionEntry($activeContext, $context);
            }

            // 5.6
            if (property_exists($context, Keyword::IMPORT->value)) {
                $this->handleImportEntry($activeContext, $context, $baseUrl);
            }

            // 5.7
            if (property_exists($context, Keyword::BASE->value) && !\count($remoteContexts)) {
                ContextEntryHandler::handleBaseEntry($result, $context);
            }

            // 5.8
            if (property_exists($context, Keyword::VOCAB->value)) {
                ContextEntryHandler::handleVocabEntry($activeContext, $result, $context);
            }

            // 5.9
            if (property_exists($context, Keyword::LANGUAGE->value)) {
                ContextEntryHandler::handleLanguageEntry($result, $context);
            }

            // 5.10
            if (property_exists($context, Keyword::DIRECTION->value)) {
                ContextEntryHandler::handleDirectionEntry($activeContext, $result, $context);
            }

            // 5.11
            if (property_exists($context, Keyword::PROPAGATE->value)) {
                ContextEntryHandler::handlePropagateEntry($activeContext, $context);
            }

            // 5.12
            $defined = [];

            // 5.13
            foreach ($context as $key => $value) {
                if (\in_array(
                    $key,
                    [
                        Keyword::BASE->value,
                        Keyword::DIRECTION->value,
                        Keyword::IMPORT->value,
                        Keyword::LANGUAGE->value,
                        Keyword::PROPAGATE->value,
                        Keyword::PROTECTED->value,
                        Keyword::VERSION->value,
                        Keyword::VOCAB->value,
                    ],
                    true,
                )) {
                    continue;
                }

                TermDefinitionCreator::create(
                    $result,
                    $context,
                    $key,
                    $defined,
                    $baseUrl,
                    $context->{Keyword::PROTECTED->value} ?? false,
                    $overrideProtected,
                    $remoteContexts,
                    $this->cache,
                );
            }
        }

        return $result;
    }

    private function handleStringContext(
        Context &$result,
        string $context,
        bool $validateScopedContext,
        array &$remoteContexts,
    ): void {
        // 5.2.1
        if (!IriResolver::isIri($result->baseUrl) && !IriResolver::isIri($context)) {
            throw new ContextProcessingException('Loading document failed');
        }

        // 5.2.1
        // The doc says to instead pass $baseUrl and to use it. However, if we do so, we don't retain the new imported context.
        // To do so, we added the newfound baseUrl to the term definition in the TermDefinitionCreator, which is not written in the doc as well.
        $context = $this->cache->canonicalizeRemoteContextUrl(IriResolver::resolveIri($result->baseUrl, $context));

        // 5.2.2
        if (!$validateScopedContext && \in_array($context, $remoteContexts, true)) {
            return;
        }

        // 5.2.3
        if (\count($remoteContexts) >= self::MAX_CONTEXTS) {
            throw new ContextProcessingException('context overflow');
        }

        $remoteContexts[] = $context;

        if ($cachedContext = $this->cache->getProcessedRemoteContext($result, $context, $validateScopedContext, $remoteContexts)) {
            $result = $cachedContext;

            return;
        }

        // 5.2.4 && 5.2.5 are done by the loadRemoteContext method
        $loadedContext = $this->cache->loadRemoteContext($context);

        // Save the pre-processing context state for the cacheability check in storeProcessedRemoteContext
        $preProcessingContext = $result;

        // 5.2.6
        $result = $this->processContext(
            $result,
            $loadedContext,
            $context,
            $remoteContexts,
            validateScopedContext: $validateScopedContext,
        );

        $this->cache->storeProcessedRemoteContext($preProcessingContext, $context, $validateScopedContext, $remoteContexts, $result);
    }

    private function handleImportEntry(Context $activeContext, \stdClass &$context, ?string $baseUrl): void
    {
        // 5.6.1
        if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
            throw new ContextProcessingException('invalid context entry');
        }

        // 5.6.2
        if (!\is_string($context->{Keyword::IMPORT->value})) {
            throw new ContextProcessingException('invalid @import value');
        }

        // 5.6.3
        $import = IriResolver::resolveIri($baseUrl, $context->{Keyword::IMPORT->value});

        // 5.6.4, 5.6.5 && 5.6.6 are done by the loadRemoteContext method
        $loadedContext = $this->cache->loadRemoteContext($import);

        if (!\is_object($loadedContext)) {
            throw new ContextProcessingException('invalid remote context');
        }

        // 5.6.7
        if (property_exists($loadedContext, Keyword::IMPORT->value)) {
            throw new ContextProcessingException('invalid context entry');
        }

        // 5.6.8
        $context = (object) array_replace((array) $loadedContext, (array) $context);
    }
}
