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
use Jolicode\JsonLd\TermDefinition\CreateTermDefinition;

class ContextProcesser
{
    public function fromJsonLd(\stdClass|array $json): Context
    {
        $activeContext = new Context();
        $localContext = new Context($this->extractContext($json));

        return $this->processContext($activeContext, $localContext);
    }

    /**
     * Takes a json_decoded JSON-LD context as input and returns a processed context.
     *
     * This is a PHP implementation of https://www.w3.org/TR/json-ld-api/#context-processing-algorithms. It is based on the 16th July 2020 recommendation.
     */
    public function processContext(
        Context $activeContext,
        Context $localContext,
        ?string $baseUrl = null,
        array $remoteContexts = [],
        bool $overrideProtected = false,
        bool $propagate = true,
        bool $validateScopedContext = true
    ): Context {
        // 1
        $result = clone $activeContext;
        $result->options->inverseContext = null;

        // 2
        if (\is_object($localContext->context) && property_exists($localContext->context, Keyword::PROPAGATE->value)) {
            $propagate = $localContext->context->{Keyword::PROPAGATE->value};
        } elseif (\is_array($localContext->context) && \array_key_exists(Keyword::PROPAGATE->value, $localContext->context)) {
            $propagate = $localContext->context[Keyword::PROPAGATE->value];
        }

        // 3
        if (!$propagate && !$activeContext->options->previousContext) {
            $result->options->previousContext = $activeContext;
        }

        // 4
        if (!\is_array($localContext->context)) {
            $localContext->context = [$localContext->context];
        }

        if (!\count($localContext->context)) {
            return $activeContext;
        }

        // 5
        foreach ($localContext->context as $index => $context) {
            // 5.1
            if (null === $context) {
                if (!$overrideProtected && $activeContext->hasProtectedTermDefinitions()) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid context nullification');
                }

                $options = new ContextOptions(
                    baseIri: $activeContext->options->baseUrl,
                    baseUrl: $activeContext->options->baseUrl,
                    previousContext: false === $propagate ? $result : null
                );

                $result = new Context(options: $options);

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
                $loadedContext = $documentLoader->load()[Keyword::CONTEXT->value];

                $result = $this->processContext(
                    $result,
                    $loadedContext,
                    $context,
                    $remoteContexts,
                    $validateScopedContext
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
                if (!\is_string($context[Keyword::IMPORT->value])) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid @import value.');
                }

                $import = IriResolver::resolveIri($baseUrl, $context[Keyword::IMPORT->value]);

                $documentLoader = new DocumentLoader($import);
                $response = $documentLoader->load();

                if (!count($response) || !array_key_exists(Keyword::CONTEXT->value, $response)) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid remote context.');
                }

                $importContext = $response[Keyword::CONTEXT->value];

                if (array_key_exists(Keyword::IMPORT->value, $importContext)) {
                    // TODO: implement real exceptions and catch them
                    throw new \Exception('Invalid context entry.');
                }

                $context = array_replace($importContext, $context);
            }

            // 5.12
            $defined = [];

            // 5.13
            foreach ($context as $key => $value) {
                CreateTermDefinition::create(
                    $result,
                    $context,
                    $key,
                    $defined,
                    $baseUrl,
                    $context->{Keyword::PROTECTED->value} ?? false,
                    $overrideProtected,
                    $remoteContexts,
                );
            }
        }

        if (1 === \count($localContext->context)) {
            if (null === $localContext->context[0]) {
                $localContext->context = new \stdClass();

                return $localContext;
            }

            $localContext->{Keyword::CONTEXT->value} = $localContext->context[0];
        }

        return $localContext;
    }

    private function extractContext(\stdClass|array $json): mixed
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
