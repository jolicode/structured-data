<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Extraction;

/**
 * Resolves RDFa terms, CURIEs and vocabularies against the DOM context they
 * appear in, and tells which of them belong to schema.org.
 *
 * Every answer is a pure function of the element context; the caches only memoize
 * that work per document, and are cleared together through reset().
 */
final class RdfaTermResolver
{
    /**
     * @var array<string, array<string>>
     */
    private array $resolvedTermsCache = [];

    /**
     * @var array<int, string|null>
     */
    private array $resolvedVocabCache = [];

    /**
     * @var array<int, array<string, string>>
     */
    private array $resolvedPrefixMappingsCache = [];

    public function reset(): void
    {
        $this->resolvedTermsCache = [];
        $this->resolvedVocabCache = [];
        $this->resolvedPrefixMappingsCache = [];
    }

    /**
     * @return array<string>
     */
    public function resolveTerms(string $attributeValue, \DOMElement $contextElement): array
    {
        if ('' === $attributeValue) {
            return [];
        }

        $cacheKey = $this->getNodeCacheKey($contextElement) . '|' . $attributeValue;

        if (\array_key_exists($cacheKey, $this->resolvedTermsCache)) {
            return $this->resolvedTermsCache[$cacheKey];
        }

        $attributeValue = trim($attributeValue);

        if ('' === $attributeValue) {
            return $this->resolvedTermsCache[$cacheKey] = [];
        }

        $tokens = preg_split('/\s+/', $attributeValue) ?: [];
        $resolvedTerms = [];

        foreach ($tokens as $token) {
            $resolvedTerm = $this->resolveTerm($token, $contextElement);

            if (null === $resolvedTerm) {
                continue;
            }

            $resolvedTerms[$resolvedTerm] = $resolvedTerm;
        }

        return $this->resolvedTermsCache[$cacheKey] = array_values($resolvedTerms);
    }

    public function resolveVocab(\DOMElement $contextElement): ?string
    {
        $cacheKey = $this->getNodeCacheKey($contextElement);

        if (\array_key_exists($cacheKey, $this->resolvedVocabCache)) {
            return $this->resolvedVocabCache[$cacheKey];
        }

        $element = $contextElement;

        while ($element instanceof \DOMElement) {
            if ($element->hasAttribute('vocab')) {
                return $this->resolvedVocabCache[$cacheKey] = trim($element->getAttribute('vocab'));
            }

            $parent = $element->parentNode;
            $element = $parent instanceof \DOMElement ? $parent : null;
        }

        return $this->resolvedVocabCache[$cacheKey] = null;
    }

    public function getNodeCacheKey(\DOMElement $element): int
    {
        return spl_object_id($element);
    }

    public function isSchemaOrgVocab(?string $vocab): bool
    {
        return \in_array($vocab, ['http://schema.org/', 'https://schema.org/'], true);
    }

    private function resolveTerm(string $token, \DOMElement $contextElement): ?string
    {
        $token = trim($token);

        if ('' === $token) {
            return null;
        }

        if (str_starts_with($token, 'https://schema.org/')) {
            $localName = substr($token, \strlen('https://schema.org/'));

            if ('' !== $localName && !str_contains($localName, '#') && !preg_match('/\s/', $localName)) {
                return $localName;
            }

            return null;
        }

        if (str_starts_with($token, 'http://schema.org/')) {
            $localName = substr($token, \strlen('http://schema.org/'));

            if ('' !== $localName && !str_contains($localName, '#') && !preg_match('/\s/', $localName)) {
                return $localName;
            }

            return null;
        }

        if (str_contains($token, ':')) {
            [$prefix, $localName] = explode(':', $token, 2);
            $prefixes = $this->resolvePrefixMappings($contextElement);

            if (isset($prefixes[$prefix]) && $this->isSchemaOrgVocab($prefixes[$prefix]) && '' !== $localName) {
                return $localName;
            }

            return null;
        }

        if ($this->isSchemaOrgVocab($this->resolveVocab($contextElement))) {
            return $token;
        }

        return null;
    }

    /**
     * @return array<string, string>
     */
    private function resolvePrefixMappings(\DOMElement $contextElement): array
    {
        $cacheKey = $this->getNodeCacheKey($contextElement);

        if (\array_key_exists($cacheKey, $this->resolvedPrefixMappingsCache)) {
            return $this->resolvedPrefixMappingsCache[$cacheKey];
        }

        $ancestors = [];
        $element = $contextElement;

        while ($element instanceof \DOMElement) {
            $ancestors[] = $element;

            $parent = $element->parentNode;
            $element = $parent instanceof \DOMElement ? $parent : null;
        }

        $ancestors = array_reverse($ancestors);
        $prefixes = [];

        foreach ($ancestors as $ancestor) {
            if (!$ancestor->hasAttribute('prefix')) {
                continue;
            }

            preg_match_all('/([A-Za-z][\w-]*):\s*(\S+)/', $ancestor->getAttribute('prefix'), $matches, \PREG_SET_ORDER);

            foreach ($matches as $match) {
                $prefixes[$match[1]] = $match[2];
            }
        }

        return $this->resolvedPrefixMappingsCache[$cacheKey] = $prefixes;
    }
}
