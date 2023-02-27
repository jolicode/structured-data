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
    public function parseJson(string $json): Context
    {
        $element = json_decode($json);

        return $this->processContext(new Context(), $this->extractContext($element));
    }

    /**
     * Takes a json_decoded JSON-LD context as input and returns a processed context.
     *
     * This is a PHP implementation of https://www.w3.org/TR/json-ld-api/#context-processing-algorithms. It is based on the 16th July 2020 recommendation.
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
            // The termDefinitions is a reference and not just a regular array, so we have to copy it without the reference
            $previousContext = new Context();

            foreach ($activeContext as $option => $value) {
                if ('termDefinitions' === $option) {
                    foreach ($value as $term => $definition) {
                        $previousContext->termDefinitions[$term] = $definition;
                    }
                } else {
                    $previousContext->{$option} = $value;
                }
            }

            $result->previousContext = $previousContext;
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
                if (!$overrideProtected && $activeContext->hasProtectedTermDefinitions()) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid context nullification');
                }

                $result = new Context(
                    baseIri: $activeContext->baseUrl,
                    baseUrl: $activeContext->baseUrl,
                    previousContext: false === $propagate ? $result : null
                );

                continue;
            }

            // 5.2
            if (\is_string($context)) {
                if (!IriResolver::isIri($baseUrl) && !IriResolver::isIri($context)) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Loading document failed');
                }

                $context = IriResolver::resolveIri($baseUrl, $context);

                if (!$validateScopedContext && \in_array($context, $remoteContexts, true)) {
                    continue;
                }

                // TODO: throw a context overflow error if length of remote contexts > defined limit

                // TODO: probably add a cache system to prevent processing the same URL multiple times
                $documentLoader = new DocumentLoader($context);
                $loadedContext = $documentLoader->load()->{Keyword::CONTEXT->value};

                // TODO: we are missing quite a lot of stuff here

                $result = $this->processContext(
                    $result,
                    $loadedContext,
                    $context,
                    $remoteContexts,
                    validateScopedContext: $validateScopedContext
                );

                continue;
            }

            // 5.3 & 5.4
            if (!\is_object($context)) {
                // TODO: implement real exceptions and catch them
                throw new \Exception('Invalid local context.');
            }

            // 5.5
            if (property_exists($context, Keyword::VERSION->value)) {
                if (1.1 !== (float) $context->{Keyword::VERSION->value}) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid @version value.');
                }
            }

            // 5.6
            if (property_exists($context, Keyword::IMPORT->value)) {
                if (!\is_string($context->{Keyword::IMPORT->value})) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid @import value.');
                }

                $import = IriResolver::resolveIri($baseUrl, $context->{Keyword::IMPORT->value});

                $documentLoader = new DocumentLoader($import);
                $response = $documentLoader->load();

                if (!\count(get_object_vars($response)) || !property_exists($response, Keyword::CONTEXT->value)) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid remote context.');
                }

                $importContext = $response[Keyword::CONTEXT->value];

                if (\array_key_exists(Keyword::IMPORT->value, $importContext)) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid context entry.');
                }

                $context = (object) array_replace($importContext, $context);
            }

            // 5.7
            if (property_exists($context, Keyword::BASE->value) && !\count($remoteContexts)) {
                // 5.7.1
                $value = $context->{Keyword::BASE->value};

                // 5.7.2
                if (!$value) {
                    $result->baseIri = null;
                // 5.7.4 : we invert 5.7.3 and 5.7.4 because it doesn't make sense to do it the other way around
                } elseif (IriResolver::isRelativeIri($value) && $result->baseIri) {
                    $result->baseIri = IriResolver::resolveIri($result->baseIri, $value);
                // 5.7.3
                } elseif (IriResolver::isIri($value)) {
                    $result->baseIri = $value;
                // 5.7.5
                } else {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('invalid base IRI');
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
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('invalid vocab mapping');
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
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('invalid default language');
                    // TODO: add language check
                }
            }

            // 5.10
            if (property_exists($context, Keyword::DIRECTION->value)) {
                // 5.10.1
                // TODO: json-ld-1.0 processing mode

                // 5.10.2
                $value = $context->{Keyword::DIRECTION->value};

                // 5.10.3
                if (!$value) {
                    $result->defaultBaseDirection = null;
                // 5.10.4
                } elseif (\is_string($value)) {
                    $result->defaultBaseDirection = $value;
                } else {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('invalid base direction');
                }
            }

            // 5.11
            if (property_exists($context, Keyword::PROPAGATE->value)) {
                // 5.11.1
                // TODO: json-ld-1.0 processing mode

                // 5.11.2
                if (!\is_bool($context->{Keyword::PROPAGATE->value})) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('invalid @propagate value');
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
            // TODO : For now we don't handle inlined contexts, like in context04-in.jsonld, so we are skipping.
            // TODO : We should take care of it. However, if we paste this context in the json-ld playground,
            // TODO : the context doesn't exist anymore, it is destroyed. So maybe we are fine like this ?
            return null;
            // return $json;
        }

        if (\is_object($json)) {
            if (property_exists($json, Keyword::CONTEXT->value)) {
                return $json->{Keyword::CONTEXT->value};
            }
        }

        return null;
    }
}
