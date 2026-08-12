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

class RdfaExtractor extends AbstractHtmlExtractor
{
    private const RDFa_CANDIDATE_XPATH = '//*[@typeof or @property or @vocab or @prefix or @about or @resource]';

    /** @var array<int, bool> */
    private array $schemaOrgCandidateCache = [];

    /** @var array<int, bool> */
    private array $schemaOrgSubjectCache = [];

    /** @var array<string, array<string>> */
    private array $resolvedTermsCache = [];

    /** @var array<int, ?string> */
    private array $resolvedVocabCache = [];

    /** @var array<int, array<string, string>> */
    private array $resolvedPrefixMappingsCache = [];

    public function getFormat(): ExtractorFormat
    {
        return ExtractorFormat::RDFA;
    }

    public function supportsContent(string $body): bool
    {
        return $this->hasRdfaAttributeMarkers($body) && $this->containsSchemaOrgIri($body);
    }

    /**
     * @return JsonLdElement[]
     */
    public function extractStructuredDataContent(string $body): array
    {
        $this->resetMemoization();

        if (!$this->supportsContent($body)) {
            return [];
        }

        $document = $this->loadDocument($body);
        $xpath = new \DOMXPath($document);
        $candidateNodes = $xpath->query(self::RDFa_CANDIDATE_XPATH);

        if (false === $candidateNodes) {
            throw new ExtractionException('Invalid RDFa document: could not query the HTML document.');
        }

        $schemaOrgCandidateNodes = [];

        foreach ($candidateNodes as $candidateNode) {
            if (!$candidateNode instanceof \DOMElement) {
                continue;
            }

            if ($this->isSchemaOrgCandidate($candidateNode)) {
                $schemaOrgCandidateNodes[] = $candidateNode;
            }
        }

        if ([] === $schemaOrgCandidateNodes) {
            return [];
        }

        $typedSchemaOrgNodes = [];

        foreach ($schemaOrgCandidateNodes as $candidateNode) {
            if (!$candidateNode->hasAttribute('typeof')) {
                continue;
            }

            if ($this->isSchemaOrgSubject($candidateNode)) {
                $typedSchemaOrgNodes[] = $candidateNode;
            }
        }

        $topLevelSubjects = [];

        foreach ($typedSchemaOrgNodes as $typedNode) {
            if (!$this->hasAncestorSchemaOrgSubject($typedNode)) {
                $topLevelSubjects[] = $typedNode;
            }
        }

        if ([] === $topLevelSubjects) {
            $candidateLines = array_map(static fn (\DOMElement $candidateNode): int => $candidateNode->getLineNo(), $schemaOrgCandidateNodes);

            throw new ExtractionException(\sprintf('Invalid RDFa document: at least one top-level schema.org subject with typeof is required%s.', $this->formatLineHint($candidateLines)), $this->formatRanges($candidateLines));
        }

        $elements = [];

        foreach ($topLevelSubjects as $subjectNode) {
            $item = $this->extractSubject($subjectNode);

            if (null === $item) {
                continue;
            }

            $encoded = json_encode($item, \JSON_UNESCAPED_SLASHES);

            if (false === $encoded) {
                throw new ExtractionException('Invalid RDFa document: failed to convert to JSON-LD.');
            }

            $elements[] = new JsonLdElement(max(0, $subjectNode->getLineNo() - 1), 0, $encoded, $this->getFormat());
        }

        if ([] === $elements) {
            $subjectLines = array_map(static fn (\DOMElement $subjectNode): int => $subjectNode->getLineNo(), $topLevelSubjects);

            throw new ExtractionException(\sprintf('Invalid RDFa document: at least one top-level schema.org subject with typeof is required%s.', $this->formatLineHint($subjectLines)), $this->formatRanges($subjectLines));
        }

        return $elements;
    }

    private function containsSchemaOrgIri(string $body): bool
    {
        return false !== stripos($body, 'https://schema.org') || false !== stripos($body, 'http://schema.org');
    }

    /**
     * Tells whether the document is worth parsing into a DOM tree.
     *
     * Only the typeof and vocab attributes can anchor a schema.org subject:
     * extraction always needs a node carrying typeof (see isSchemaOrgSubject()),
     * and the "no top-level subject" diagnostic needs a schema.org candidate,
     * which needs either a schema.org vocab or a resolvable typeof. The other
     * RDFa attributes - property, prefix, about, resource - can never produce
     * one on their own.
     *
     * The test matches attribute syntax rather than bare substrings: a substring
     * test hits ordinary prose and unrelated markup ("about" alone matched 58%
     * of a 100-page sample, "property" 89% because of Open Graph meta tags), and
     * every hit costs a full libxml parse of the document.
     */
    private function hasRdfaAttributeMarkers(string $body): bool
    {
        return 1 === preg_match('#\s(?:typeof|vocab)\s*=#i', $body);
    }

    private function isSchemaOrgCandidate(\DOMElement $element): bool
    {
        $cacheKey = $this->getNodeCacheKey($element);

        if (\array_key_exists($cacheKey, $this->schemaOrgCandidateCache)) {
            return $this->schemaOrgCandidateCache[$cacheKey];
        }

        if ($this->isSchemaOrgVocab($this->resolveVocab($element))) {
            return $this->schemaOrgCandidateCache[$cacheKey] = true;
        }

        $typeof = $element->getAttribute('typeof');

        if ('' !== $typeof && [] !== $this->resolveTerms($typeof, $element)) {
            return $this->schemaOrgCandidateCache[$cacheKey] = true;
        }

        $property = $element->getAttribute('property');

        return $this->schemaOrgCandidateCache[$cacheKey] = '' !== $property && [] !== $this->resolveTerms($property, $element);
    }

    private function isSchemaOrgSubject(\DOMElement $element): bool
    {
        $cacheKey = $this->getNodeCacheKey($element);

        if (\array_key_exists($cacheKey, $this->schemaOrgSubjectCache)) {
            return $this->schemaOrgSubjectCache[$cacheKey];
        }

        $typeof = $element->getAttribute('typeof');

        return $this->schemaOrgSubjectCache[$cacheKey] = '' !== $typeof && [] !== $this->resolveTerms($typeof, $element);
    }

    private function hasAncestorSchemaOrgSubject(\DOMElement $element): bool
    {
        $parent = $element->parentNode;

        while ($parent instanceof \DOMElement) {
            if ($this->isSchemaOrgSubject($parent)) {
                return true;
            }

            $parent = $parent->parentNode;
        }

        return false;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function extractSubject(\DOMElement $subjectNode): ?array
    {
        $types = $this->resolveTerms($subjectNode->getAttribute('typeof'), $subjectNode);

        if ([] === $types) {
            return null;
        }

        $item = [
            '@context' => 'https://schema.org',
            '@type' => 1 === \count($types) ? $types[0] : $types,
        ];

        $subjectIdentifier = $this->extractSubjectIdentifier($subjectNode);

        if (null !== $subjectIdentifier) {
            $item['@id'] = $subjectIdentifier;
        }

        foreach ($this->extractProperties($subjectNode) as $propertyName => $value) {
            $item[$propertyName] = $value;
        }

        return $item;
    }

    /**
     * @return array<string, mixed>
     */
    private function extractProperties(\DOMElement $subjectNode): array
    {
        $properties = [];

        foreach ($this->collectPropertyNodesForSubject($subjectNode) as $propertyNode) {
            $propertyNames = $this->resolveTerms($propertyNode->getAttribute('property'), $propertyNode);

            if ([] === $propertyNames) {
                continue;
            }

            $value = $propertyNode->hasAttribute('typeof')
                ? $this->extractSubject($propertyNode)
                : $this->extractPropertyValue($propertyNode);

            if (null === $value) {
                continue;
            }

            foreach ($propertyNames as $propertyName) {
                if (\array_key_exists($propertyName, $properties)) {
                    if (!\is_array($properties[$propertyName]) || !array_is_list($properties[$propertyName])) {
                        $properties[$propertyName] = [$properties[$propertyName]];
                    }

                    $properties[$propertyName][] = $value;
                } else {
                    $properties[$propertyName] = $value;
                }
            }
        }

        return $properties;
    }

    /**
     * @return array<\DOMElement>
     */
    private function collectPropertyNodesForSubject(\DOMElement $subjectNode): array
    {
        $propertyNodes = [];
        $stack = [];

        foreach ($subjectNode->childNodes as $childNode) {
            if ($childNode instanceof \DOMElement) {
                $stack[] = $childNode;
            }
        }

        while ($stack) {
            $node = array_pop($stack);

            if ($node->hasAttribute('property')) {
                $propertyNodes[] = $node;
            }

            // Skip descending into schema.org subjects that don't have property attributes
            // (property+typeof nodes are handled above and their nested subjects are extracted in extractProperties)
            if ($this->isSchemaOrgSubject($node) && !$node->hasAttribute('property')) {
                continue;
            }

            foreach ($node->childNodes as $childNode) {
                if ($childNode instanceof \DOMElement) {
                    $stack[] = $childNode;
                }
            }
        }

        return $propertyNodes;
    }

    private function extractSubjectIdentifier(\DOMElement $subjectNode): ?string
    {
        foreach (['about', 'resource', 'href', 'src'] as $attribute) {
            if ($subjectNode->hasAttribute($attribute)) {
                $value = trim($subjectNode->getAttribute($attribute));

                if ('' !== $value) {
                    return $value;
                }
            }
        }

        return null;
    }

    private function extractPropertyValue(\DOMElement $propertyNode): ?string
    {
        foreach (['content', 'resource', 'href', 'src', 'datetime', 'value'] as $attribute) {
            if ($propertyNode->hasAttribute($attribute)) {
                $value = trim($propertyNode->getAttribute($attribute));

                if ('' !== $value) {
                    return $value;
                }
            }
        }

        $normalizedText = preg_replace('/\s+/u', ' ', $propertyNode->textContent);

        if (!\is_string($normalizedText)) {
            return null;
        }

        $text = trim($normalizedText);

        return '' === $text ? null : $text;
    }

    /**
     * @return array<string>
     */
    private function resolveTerms(string $attributeValue, \DOMElement $contextElement): array
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

    private function resolveVocab(\DOMElement $contextElement): ?string
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

    private function resetMemoization(): void
    {
        $this->schemaOrgCandidateCache = [];
        $this->schemaOrgSubjectCache = [];
        $this->resolvedTermsCache = [];
        $this->resolvedVocabCache = [];
        $this->resolvedPrefixMappingsCache = [];
    }

    private function getNodeCacheKey(\DOMElement $element): int
    {
        return spl_object_id($element);
    }

    private function isSchemaOrgVocab(?string $vocab): bool
    {
        return \in_array($vocab, ['http://schema.org/', 'https://schema.org/'], true);
    }
}
