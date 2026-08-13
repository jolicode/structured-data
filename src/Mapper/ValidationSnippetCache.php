<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Mapper;

use JoliCode\StructuredData\Extraction\JsonLdElement;

/**
 * Caches the validation outcome of a JSON-LD snippet so that a snippet repeated
 * across documents (or within one document) is only expanded and validated once.
 *
 * On a cache hit, the snippet is still re-mapped against its parsed structure - so
 * line/column ranges stay specific to each occurrence - but the validators are
 * skipped: their outcome is replayed from a serialized "template" of the previous
 * validation.
 *
 * The cache is deliberately usable across audits (a worker validating many pages
 * of one site meets the same snippets over and over), and bounded by an LRU
 * eviction policy so that a long-lived process cannot grow it indefinitely.
 */
class ValidationSnippetCache
{
    /**
     * @var array<string, array{expandedJsonLd: array, validatedTypesByElement: array<int, array<int, array<string, mixed>>>}>
     */
    private array $entries = [];

    public function __construct(
        private readonly int $maxEntries = 32,
    ) {
    }

    /**
     * @param array<object> $validators
     */
    public function getKey(JsonLdElement $jsonLdElement, array $validators): string
    {
        $validatorsSignature = implode(
            "\0",
            array_map(
                static fn (object $validator): string => $validator::class,
                $validators,
            ),
        );

        return md5(
            $jsonLdElement->sourceFormat->value
            . "\0"
            . $validatorsSignature
            . "\0"
            . $jsonLdElement->content,
        );
    }

    /**
     * @return array{expandedJsonLd: array, validatedTypesByElement: array<int, array<int, array<string, mixed>>>}|null
     */
    public function get(string $key): ?array
    {
        if (!isset($this->entries[$key])) {
            return null;
        }

        // Move the entry to the end of the array so that the LRU eviction
        // (which removes from the front) keeps recently used entries alive.
        $entry = $this->entries[$key];
        unset($this->entries[$key]);

        return $this->entries[$key] = $entry;
    }

    /**
     * @param array<int, array<int, array<string, mixed>>> $validatedTypesByElement
     */
    public function store(string $key, array $expandedJsonLd, array $validatedTypesByElement): void
    {
        unset($this->entries[$key]);

        $this->entries[$key] = [
            'expandedJsonLd' => $expandedJsonLd,
            'validatedTypesByElement' => $validatedTypesByElement,
        ];

        while (\count($this->entries) > $this->maxEntries) {
            $oldestKey = array_key_first($this->entries);

            if (null === $oldestKey) {
                break;
            }

            unset($this->entries[$oldestKey]);
        }
    }

    public function reset(): void
    {
        $this->entries = [];
    }
}
