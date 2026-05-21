<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\ContextProcessing;

use Jolicode\JsonLd\Algorithms\Exception\ContextProcessingException;
use Jolicode\JsonLd\Algorithms\Http\DocumentLoader;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Jolicode\JsonLd\Algorithms\TermDefinition\TermDefinition;

final class ContextCache
{
    private const SCHEMA_ORG_CANONICAL_URL = 'https://schema.org/';
    private const SCHEMA_ORG_URL_VARIANTS = [
        'http://schema.org',
        'http://schema.org/',
        'https://schema.org',
        'https://schema.org/',
    ];
    private const SCHEMA_ORG_LOCAL_FILE = __DIR__ . '/../../../../resources/schema.org/context/schemaorg-context.jsonld';
    private const SCHEMA_ORG_STATIC_FILE = __DIR__ . '/../../../../resources/schema.org/context/schemaorg-static-context.php';

    /** @var array<string, Context> */
    private static array $processedRemoteContexts = [];

    private static \stdClass|array|string|null $schemaOrgContext = null;

    /** @var array<string, \stdClass|array<mixed>|string> */
    private array $alreadyLoadedDocuments = [];

    public function canonicalizeRemoteContextUrl(string $resolvedContext): string
    {
        if (\in_array($resolvedContext, self::SCHEMA_ORG_URL_VARIANTS, true)) {
            return self::SCHEMA_ORG_CANONICAL_URL;
        }

        return $resolvedContext;
    }

    public function getProcessedRemoteContext(Context $context, string $resolvedContext, bool $validateScopedContext, array $remoteContexts): ?Context
    {
        if (!$this->isCacheableRemoteContextProcessing($context, $validateScopedContext, $remoteContexts)) {
            return null;
        }

        $cacheKey = $this->buildProcessedContextCacheKey($context, $resolvedContext);

        if (!\array_key_exists($cacheKey, self::$processedRemoteContexts)) {
            if (!$this->isSchemaOrgStaticCandidate($resolvedContext, $context)) {
                return null;
            }

            $this->hydrateSchemaOrgStatic($cacheKey, $context);
        }

        return ContextCloner::duplicate(self::$processedRemoteContexts[$cacheKey]);
    }

    public function storeProcessedRemoteContext(Context $context, string $resolvedContext, bool $validateScopedContext, array $remoteContexts, Context $processedContext): void
    {
        if (!$this->isCacheableRemoteContextProcessing($context, $validateScopedContext, $remoteContexts)) {
            return;
        }

        $cacheKey = $this->buildProcessedContextCacheKey($context, $resolvedContext);
        self::$processedRemoteContexts[$cacheKey] = ContextCloner::duplicate($processedContext);
    }

    public function loadRemoteContext(string $url): \stdClass|array|string|null
    {
        if (\array_key_exists($url, $this->alreadyLoadedDocuments)) {
            return $this->alreadyLoadedDocuments[$url];
        }

        if (self::SCHEMA_ORG_CANONICAL_URL === $url) {
            if (null === self::$schemaOrgContext) {
                $document = json_decode((string) file_get_contents(self::SCHEMA_ORG_LOCAL_FILE));
                self::$schemaOrgContext = $document->{Keyword::CONTEXT->value};
            }

            return self::$schemaOrgContext;
        }

        $documentLoader = new DocumentLoader($url);
        $document = $documentLoader->load();

        if (!property_exists($document, Keyword::CONTEXT->value)) {
            throw new ContextProcessingException('invalid remote context');
        }

        if (
            null === $document->{Keyword::CONTEXT->value}
            && property_exists($document, 'statusCode')
            && property_exists($document, 'content')
        ) {
            throw new ContextProcessingException(\sprintf('loading remote context failed. Response status code is : %d. Response content is : %s', $document->{'statusCode'}, $document->{'content'}));
        }

        $loadedContext = $document->{Keyword::CONTEXT->value};
        $this->alreadyLoadedDocuments[$url] = $loadedContext;

        return $loadedContext;
    }

    private function isCacheableRemoteContextProcessing(Context $context, bool $validateScopedContext, array $remoteContexts): bool
    {
        if (!$validateScopedContext || 1 !== \count($remoteContexts)) {
            return false;
        }

        return [] === $context->termDefinitions
            && null === $context->vocabularyMapping
            && null === $context->defaultLangage
            && null === $context->defaultBaseDirection
            && null === $context->previousContext
            && null === $context->inverseContext;
    }

    private function hydrateSchemaOrgStatic(string $cacheKey, Context $sourceContext): void
    {
        $data = require self::SCHEMA_ORG_STATIC_FILE;

        $context = new Context(
            baseIri: $sourceContext->baseIri,
            baseUrl: $sourceContext->baseUrl,
            vocabularyMapping: $data['vocab'],
            processingMode: $sourceContext->processingMode,
        );

        foreach ($data['terms'] as $term => [$iriMapping, $prefixFlag, $typeMapping]) {
            $context->termDefinitions[$term] = new TermDefinition(
                prefixFlag: $prefixFlag,
                protected: false,
                reverseProperty: false,
                iriMapping: $iriMapping,
                typeMapping: $typeMapping,
            );
        }

        self::$processedRemoteContexts[$cacheKey] = $context;
    }

    private function isSchemaOrgStaticCandidate(string $resolvedContext, Context $context): bool
    {
        return self::SCHEMA_ORG_CANONICAL_URL === $resolvedContext
            && Context::PROCESSING_MODE_11 === $context->processingMode;
    }

    private function buildProcessedContextCacheKey(Context $context, string $resolvedContext): string
    {
        return \sprintf('%s|%s|%s', $resolvedContext, $context->processingMode ?? '', $context->baseUrl ?? '');
    }
}
