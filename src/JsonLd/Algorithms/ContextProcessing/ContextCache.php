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

    /**
     * Maximum number of processed remote contexts kept in memory. Each entry holds
     * a full Context with thousands of term definitions; the cache key includes the
     * base URL, so processing documents with many distinct bases would otherwise
     * grow this cache indefinitely in a long-lived process.
     */
    private const MAX_PROCESSED_REMOTE_CONTEXTS = 32;

    /** @var array<string, Context> */
    private static array $processedRemoteContexts = [];

    private static \stdClass|array|string|null $schemaOrgContext = null;

    /**
     * The schema.org term definitions, built once per process from the static
     * file. They are readonly value objects shared by every context that uses
     * them, so they are never rebuilt.
     *
     * @var array<string, TermDefinition>|null
     */
    private static ?array $schemaOrgStaticTermDefinitions = null;

    private static ?string $schemaOrgStaticVocabularyMapping = null;

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
            // The remote context is processed on top of an already populated
            // active context, which the cache above cannot serve: this happens
            // whenever a document repeats "@context": "https://schema.org" inside
            // its @graph nodes or in a scoped context, and rebuilding the ~3.000
            // schema.org term definitions costs around 30 ms every single time.
            return $this->mergeSchemaOrgStaticContext($context, $resolvedContext);
        }

        $cacheKey = $this->buildProcessedContextCacheKey($context, $resolvedContext);

        if (!\array_key_exists($cacheKey, self::$processedRemoteContexts)) {
            if (!$this->isSchemaOrgStaticCandidate($resolvedContext, $context)) {
                return null;
            }

            $this->hydrateSchemaOrgStatic($cacheKey, $context);
        }

        // Move the entry to the end of the array so that the LRU eviction
        // (which removes from the front) keeps recently used entries alive.
        $processedContext = self::$processedRemoteContexts[$cacheKey];
        unset(self::$processedRemoteContexts[$cacheKey]);
        self::$processedRemoteContexts[$cacheKey] = $processedContext;

        return ContextCloner::duplicate($processedContext);
    }

    public function storeProcessedRemoteContext(Context $context, string $resolvedContext, bool $validateScopedContext, array $remoteContexts, Context $processedContext): void
    {
        if (!$this->isCacheableRemoteContextProcessing($context, $validateScopedContext, $remoteContexts)) {
            return;
        }

        $cacheKey = $this->buildProcessedContextCacheKey($context, $resolvedContext);
        self::$processedRemoteContexts[$cacheKey] = ContextCloner::duplicate($processedContext);
        self::evictLeastRecentlyUsedProcessedContexts();
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

        while (\count($this->alreadyLoadedDocuments) > self::MAX_PROCESSED_REMOTE_CONTEXTS) {
            unset($this->alreadyLoadedDocuments[array_key_first($this->alreadyLoadedDocuments)]);
        }

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
        $termDefinitions = self::getSchemaOrgStaticTermDefinitions();

        $context = new Context(
            termDefinitions: $termDefinitions,
            baseIri: $sourceContext->baseIri,
            baseUrl: $sourceContext->baseUrl,
            vocabularyMapping: self::$schemaOrgStaticVocabularyMapping,
            processingMode: $sourceContext->processingMode,
        );

        self::$processedRemoteContexts[$cacheKey] = $context;
        self::evictLeastRecentlyUsedProcessedContexts();
    }

    /**
     * Applies the schema.org context to an already populated active context
     * without rebuilding its term definitions.
     *
     * Term definitions are readonly value objects, so the same instances can be
     * shared by every context that defines the term.
     */
    private function mergeSchemaOrgStaticContext(Context $context, string $resolvedContext): ?Context
    {
        if (!$this->isSchemaOrgStaticCandidate($resolvedContext, $context)) {
            return null;
        }

        // Redefining a protected term must raise, which only the full context
        // processing algorithm can decide: leave those documents to it.
        if ($context->hasProtectedTermDefinitions()) {
            return null;
        }

        $termDefinitions = self::getSchemaOrgStaticTermDefinitions();

        $merged = ContextCloner::duplicate($context);
        $merged->vocabularyMapping = self::$schemaOrgStaticVocabularyMapping;
        // array_replace() overwrites the terms the active context already defines
        // and keeps their position, exactly like defining them one by one does.
        $merged->termDefinitions = array_replace($merged->termDefinitions, $termDefinitions);

        return $merged;
    }

    /**
     * @return array<string, TermDefinition>
     */
    private static function getSchemaOrgStaticTermDefinitions(): array
    {
        if (null !== self::$schemaOrgStaticTermDefinitions) {
            return self::$schemaOrgStaticTermDefinitions;
        }

        /** @var array{vocab: string, terms: array<string, array{string, bool, ?string}>} $data */
        $data = require self::SCHEMA_ORG_STATIC_FILE;
        $termDefinitions = [];

        foreach ($data['terms'] as $term => [$iriMapping, $prefixFlag, $typeMapping]) {
            $termDefinitions[$term] = new TermDefinition(
                prefixFlag: $prefixFlag,
                protected: false,
                reverseProperty: false,
                iriMapping: $iriMapping,
                typeMapping: $typeMapping,
            );
        }

        self::$schemaOrgStaticVocabularyMapping = $data['vocab'];

        return self::$schemaOrgStaticTermDefinitions = $termDefinitions;
    }

    private static function evictLeastRecentlyUsedProcessedContexts(): void
    {
        while (\count(self::$processedRemoteContexts) > self::MAX_PROCESSED_REMOTE_CONTEXTS) {
            unset(self::$processedRemoteContexts[array_key_first(self::$processedRemoteContexts)]);
        }
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
