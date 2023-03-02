<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\ContextProcessing;

use Jolicode\JsonLd\Http\DocumentLoader;
use Jolicode\JsonLd\Http\IriResolver;
use Jolicode\JsonLd\JsonLd\Keyword;
use Jolicode\JsonLd\TermDefinition\TermDefinitionCreator;

class ContextProcesser
{
    private const MAX_CONTEXTS = 10;

    private array $alreadyLoadedDocuments = [];

    public function parseJson(string $json): Context
    {
        $element = json_decode($json);

        return $this->processContext(new Context(), $this->extractContext($element));
    }

    /**
     * Takes a json_decoded JSON-LD context as input and returns a processed context.
     *
     * This is a PHP implementation of the Context Processing algorithm https://www.w3.org/TR/json-ld-api/#context-processing-algorithms. It is based on the 16th July 2020 recommendation.
     */
    public function processContext(
        Context $activeContext,
        array|\stdClass|null|string $localContext,
        ?string $baseUrl = null,
        array $remoteContexts = [],
        bool $overrideProtected = false,
        bool $propagate = true,
        bool $validateScopedContext = true
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

        // 5
        foreach ($localContext as $context) {
            // 5.1
            if (null === $context) {
                // 5.1.1
                if (!$overrideProtected && $activeContext->hasProtectedTermDefinitions()) {
                    throw new ContextProcessingException('Invalid context nullification');
                }

                // 5.1.2
                $result = new Context(
                    baseIri: $activeContext->baseUrl,
                    baseUrl: $activeContext->baseUrl,
                    previousContext: false === $propagate ? $result : null
                );

                // 5.1.3
                continue;
            }

            // 5.2
            if (\is_string($context)) {
                // 5.2.1
                if (!IriResolver::isIri($baseUrl) && !IriResolver::isIri($context)) {
                    throw new ContextProcessingException('Loading document failed');
                }

                // 5.2.1
                $context = IriResolver::resolveIri($baseUrl, $context);

                // 5.2.2
                if (!$validateScopedContext && \in_array($context, $remoteContexts, true)) {
                    continue;
                }

                // 5.2.3
                if (\count($remoteContexts) >= self::MAX_CONTEXTS) {
                    throw new ContextProcessingException('context overflow');
                }

                // 5.2.4 && 5.2.5 are done by the loadRemoteContext method
                $loadedContext = $this->loadRemoteContext($context);

                // 5.2.6
                $result = $this->processContext(
                    $result,
                    $loadedContext,
                    $context,
                    $remoteContexts,
                    validateScopedContext: $validateScopedContext
                );

                // 5.2.7
                continue;
            }

            // 5.3 & 5.4
            if (!\is_object($context)) {
                throw new ContextProcessingException('Invalid local context.');
            }

            // 5.5
            if (property_exists($context, Keyword::VERSION->value)) {
                // 5.5.1
                if (1.1 !== (float) $context->{Keyword::VERSION->value}) {
                    throw new ContextProcessingException('Invalid @version value.');
                }

                // 5.5.2
                if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                    throw new ContextProcessingException('processing mode conflict.');
                }
            }

            // 5.6
            if (property_exists($context, Keyword::IMPORT->value)) {
                // 5.6.1
                if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                    throw new ContextProcessingException('invalid context entry.');
                }

                // 5.6.2
                if (!\is_string($context->{Keyword::IMPORT->value})) {
                    throw new ContextProcessingException('Invalid @import value.');
                }

                // 5.6.3
                $import = IriResolver::resolveIri($baseUrl, $context->{Keyword::IMPORT->value});

                // 5.6.4, 5.6.5 && 5.6.6 are done by the loadRemoteContext method

                $loadedContext = $this->loadRemoteContext($import);

                // 5.6.7
                if (property_exists($loadedContext, Keyword::IMPORT->value)) {
                    throw new ContextProcessingException('Invalid context entry.');
                }

                // 5.6.8
                $context = (object) array_replace((array) $loadedContext, (array) $context);
            }

            // 5.7
            if (property_exists($context, Keyword::BASE->value) && !\count($remoteContexts)) {
                // 5.7.1
                $value = $context->{Keyword::BASE->value};

                // 5.7.2
                if (!$value) {
                    $result->baseIri = $value;
                // 5.7.4 : we invert 5.7.3 and 5.7.4 because it doesn't make sense to do it the other way around
                } elseif (IriResolver::isRelativeIri($value) && $result->baseIri) {
                    $result->baseIri = IriResolver::resolveIri($result->baseIri, $value);
                // 5.7.3
                } elseif (IriResolver::isIri($value)) {
                    $result->baseIri = $value;
                // 5.7.5
                } else {
                    throw new ContextProcessingException('invalid base IRI');
                }
            }

            // 5.8
            if (property_exists($context, Keyword::VOCAB->value)) {
                // 5.8.1
                $value = $context->{Keyword::VOCAB->value};

                // 5.8.2
                if (null === $value) {
                    $result->vocabularyMapping = null;
                // 5.8.3
                // We don't follow the W3C documentation as it is not working with empty @vocab keys (like in the 0092 test).
                // Instead we follow the JS library documentation, which works
                } elseif (!IriResolver::isAbsoluteIri($value) && Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                    throw new ContextProcessingException('invalid vocab mapping');
                } else {
                    $result->vocabularyMapping = IriResolver::expand($result, $value, true);
                }
            }

            // 5.9
            if (property_exists($context, Keyword::LANGUAGE->value)) {
                // 5.9.1
                $value = $context->{Keyword::LANGUAGE->value};

                // 5.9.2
                if (!$value) {
                    $result->defaultLangage = null;
                // 5.9.3
                } elseif (\is_string($value)) {
                    $result->defaultLangage = $value;
                } else {
                    throw new ContextProcessingException('invalid default language');
                }
            }

            // 5.10
            if (property_exists($context, Keyword::DIRECTION->value)) {
                // 5.10.1
                if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                    throw new ContextProcessingException('invalid context entry.');
                }

                // 5.10.2
                $value = $context->{Keyword::DIRECTION->value};

                // 5.10.3
                if (!$value) {
                    $result->defaultBaseDirection = null;
                // 5.10.4
                } elseif (\is_string($value)) {
                    $result->defaultBaseDirection = $value;
                } else {
                    throw new ContextProcessingException('invalid base direction');
                }
            }

            // 5.11
            if (property_exists($context, Keyword::PROPAGATE->value)) {
                // 5.11.1
                if (Context::PROCESSING_MODE_10 === $activeContext->processingMode) {
                    throw new ContextProcessingException('invalid context entry.');
                }

                // 5.11.2
                if (!\is_bool($context->{Keyword::PROPAGATE->value})) {
                    throw new ContextProcessingException('invalid @propagate value');
                }
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
                    true
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
                    $remoteContexts
                );
            }
        }

        // 6
        return $result;
    }

    public function extractContext(\stdClass|array $json): mixed
    {
        if (\is_array($json)) {
            return null;
        }

        if (\is_object($json)) {
            if (property_exists($json, Keyword::CONTEXT->value)) {
                return $json->{Keyword::CONTEXT->value};
            }
        }

        return null;
    }

    private function loadRemoteContext(string $url): \stdClass|string
    {
        if (\array_key_exists($url, $this->alreadyLoadedDocuments)) {
            $loadedContext = $this->alreadyLoadedDocuments[$url];
        } else {
            $documentLoader = new DocumentLoader($url);
            $document = $documentLoader->load();

            if (!property_exists($document, Keyword::CONTEXT->value)) {
                throw new ContextProcessingException('invalid remote context');
            }

            // This will only be true if the response status code is 400 or more
            if (
                null === $document->{Keyword::CONTEXT->value} &&
                property_exists($document, 'statusCode') &&
                property_exists($document, 'content')
            ) {
                throw new ContextProcessingException(sprintf('loading remote context failed. Response status code is : %d. Response content is : %s', $document->{'statusCode'}, $document->{'content'}));
            }

            $loadedContext = $document->{Keyword::CONTEXT->value};
            $this->alreadyLoadedDocuments[$url] = $loadedContext;
        }

        return $loadedContext;
    }
}
