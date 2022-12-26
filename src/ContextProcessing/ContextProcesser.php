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

use Jolicode\JsonLd\JsonLd\Keyword;
use Jolicode\JsonLd\TermDefinition\CreateTermDefinition;

class ContextProcesser
{
    public function fromJsonLd(\stdClass|array $json): \stdClass
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
    ): \stdClass {
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
                    baseIRI: $activeContext->options->baseURL,
                    baseURL: $activeContext->options->baseURL,
                    previousContext: false === $propagate ? $result : null
                );

                $result = new Context(options: $options);

                continue;
                // 5.2
            }

            if (\is_string($context)) {
                // Context is a remote reference.
                // It requires us to do some HTTP calls, HTML parsing and other things.
                // We skip it for now, it will be implemented later.
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

                // Again, it requires to do HTTP calls : skipping for now.
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

        $context = new \stdClass();

        if (1 === \count($localContext->context)) {
            if (null === $localContext->context[0]) {
                return new \stdClass();
            }

            $context->{Keyword::CONTEXT->value} = $localContext->context[0];
        }

        if (1 < \count($localContext->context)) {
            $context->{Keyword::CONTEXT->value} = $localContext->context;
        }

        return $context;
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
