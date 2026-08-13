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

    private readonly RdfaTermResolver $termResolver;

    public function __construct(
        HtmlDocumentLoader $documentLoader = new HtmlDocumentLoader(),
        ?RdfaTermResolver $termResolver = null,
    ) {
        parent::__construct($documentLoader);

        $this->termResolver = $termResolver ?? new RdfaTermResolver();
    }

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

            $elements[] = $this->encodeAsJsonLdElement($subjectNode, $item, 'Invalid RDFa document: failed to convert to JSON-LD.');
        }

        if ([] === $elements) {
            $this->throwEmptyResult($topLevelSubjects, 'Invalid RDFa document: at least one top-level schema.org subject with typeof is required');
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
        $cacheKey = $this->termResolver->getNodeCacheKey($element);

        if (\array_key_exists($cacheKey, $this->schemaOrgCandidateCache)) {
            return $this->schemaOrgCandidateCache[$cacheKey];
        }

        if ($this->termResolver->isSchemaOrgVocab($this->termResolver->resolveVocab($element))) {
            return $this->schemaOrgCandidateCache[$cacheKey] = true;
        }

        $typeof = $element->getAttribute('typeof');

        if ('' !== $typeof && [] !== $this->termResolver->resolveTerms($typeof, $element)) {
            return $this->schemaOrgCandidateCache[$cacheKey] = true;
        }

        $property = $element->getAttribute('property');

        return $this->schemaOrgCandidateCache[$cacheKey] = '' !== $property && [] !== $this->termResolver->resolveTerms($property, $element);
    }

    private function isSchemaOrgSubject(\DOMElement $element): bool
    {
        $cacheKey = $this->termResolver->getNodeCacheKey($element);

        if (\array_key_exists($cacheKey, $this->schemaOrgSubjectCache)) {
            return $this->schemaOrgSubjectCache[$cacheKey];
        }

        $typeof = $element->getAttribute('typeof');

        return $this->schemaOrgSubjectCache[$cacheKey] = '' !== $typeof && [] !== $this->termResolver->resolveTerms($typeof, $element);
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
        $types = $this->termResolver->resolveTerms($subjectNode->getAttribute('typeof'), $subjectNode);

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
            $propertyNames = $this->termResolver->resolveTerms($propertyNode->getAttribute('property'), $propertyNode);

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

    private function resetMemoization(): void
    {
        $this->termResolver->reset();
        $this->schemaOrgCandidateCache = [];
        $this->schemaOrgSubjectCache = [];
    }
}
