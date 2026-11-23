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
        $xpath = new \Dom\XPath($document);
        $candidateNodes = $xpath->query(self::RDFa_CANDIDATE_XPATH);

        $schemaOrgCandidateNodes = [];

        foreach ($candidateNodes as $candidateNode) {
            if (!$candidateNode instanceof \Dom\Element) {
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
            $candidateLines = array_map(static fn (\Dom\Element $candidateNode): int => self::lineOf($candidateNode), $schemaOrgCandidateNodes);

            throw new ExtractionException(\sprintf('Invalid RDFa document: at least one top-level schema.org subject with typeof is required%s.', $this->formatLineHint($candidateLines)), $this->formatRanges($candidateLines));
        }

        $elements = [];
        $locator = $this->loadLocator($body);

        foreach ($topLevelSubjects as $subjectNode) {
            $extracted = $this->extractSubject($subjectNode, $locator);

            if (null === $extracted) {
                continue;
            }

            [$item, $sourceMap] = $extracted;
            $elements[] = $this->encodeAsJsonLdElement($subjectNode, $item, 'Invalid RDFa document: failed to convert to JSON-LD.', $sourceMap);
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
     * every hit costs a full parse of the document.
     */
    private function hasRdfaAttributeMarkers(string $body): bool
    {
        return 1 === preg_match('#\s(?:typeof|vocab)\s*=#i', $body);
    }

    private function isSchemaOrgCandidate(\Dom\Element $element): bool
    {
        $cacheKey = $this->termResolver->getNodeCacheKey($element);

        if (\array_key_exists($cacheKey, $this->schemaOrgCandidateCache)) {
            return $this->schemaOrgCandidateCache[$cacheKey];
        }

        if ($this->termResolver->isSchemaOrgVocab($this->termResolver->resolveVocab($element))) {
            return $this->schemaOrgCandidateCache[$cacheKey] = true;
        }

        $typeof = $element->getAttribute('typeof') ?? '';

        if ('' !== $typeof && [] !== $this->termResolver->resolveTerms($typeof, $element)) {
            return $this->schemaOrgCandidateCache[$cacheKey] = true;
        }

        $property = $element->getAttribute('property') ?? '';

        return $this->schemaOrgCandidateCache[$cacheKey] = '' !== $property && [] !== $this->termResolver->resolveTerms($property, $element);
    }

    private function isSchemaOrgSubject(\Dom\Element $element): bool
    {
        $cacheKey = $this->termResolver->getNodeCacheKey($element);

        if (\array_key_exists($cacheKey, $this->schemaOrgSubjectCache)) {
            return $this->schemaOrgSubjectCache[$cacheKey];
        }

        $typeof = $element->getAttribute('typeof') ?? '';

        return $this->schemaOrgSubjectCache[$cacheKey] = '' !== $typeof && [] !== $this->termResolver->resolveTerms($typeof, $element);
    }

    private function hasAncestorSchemaOrgSubject(\Dom\Element $element): bool
    {
        $parent = $element->parentNode;

        while ($parent instanceof \Dom\Element) {
            if ($this->isSchemaOrgSubject($parent)) {
                return true;
            }

            $parent = $parent->parentNode;
        }

        return false;
    }

    /**
     * Extracts a subject, with the source map of its keys and values from its
     * own root.
     *
     * @return array{array<string, mixed>, SourceMap}|null
     */
    private function extractSubject(\Dom\Element $subjectNode, HtmlSourceLocator $locator): ?array
    {
        $types = $this->termResolver->resolveTerms($subjectNode->getAttribute('typeof') ?? '', $subjectNode);

        if ([] === $types) {
            return null;
        }

        $item = [
            '@context' => 'https://schema.org',
            '@type' => 1 === \count($types) ? $types[0] : $types,
        ];

        $anchor = self::anchorOf($locator, $subjectNode);
        $sourceMap = new SourceMap();
        $sourceMap->setValue('', $anchor);
        // The context is implied by the markup, written nowhere.
        $sourceMap->setKey('/@context', $anchor);
        $sourceMap->setValue('/@context', $anchor);
        $sourceMap->setKey('/@type', $locator->attributeName($subjectNode, 'typeof'));
        $sourceMap->setValue('/@type', $locator->attributeValue($subjectNode, 'typeof'));

        if (\count($types) > 1) {
            $typeTokens = $this->termTokenIndexes($subjectNode, 'typeof');

            foreach ($types as $index => $type) {
                $sourceMap->setValue('/@type' . SourceMap::pointerSegment($index), $locator->attributeToken($subjectNode, 'typeof', $typeTokens[$type] ?? -1));
            }
        }

        $subjectIdentifier = $this->extractSubjectIdentifier($subjectNode);

        if (null !== $subjectIdentifier) {
            [$identifier, $identifierAttribute] = $subjectIdentifier;
            $item['@id'] = $identifier;
            $sourceMap->setKey('/@id', $locator->attributeName($subjectNode, $identifierAttribute));
            $sourceMap->setValue('/@id', $locator->attributeValue($subjectNode, $identifierAttribute));
        }

        [$properties, $propertiesSourceMap] = $this->extractProperties($subjectNode, $locator);

        foreach ($properties as $propertyName => $value) {
            $item[$propertyName] = $value;
        }

        $sourceMap->merge($propertiesSourceMap, '');

        return [$item, $sourceMap];
    }

    /**
     * @return array{array<string, mixed>, SourceMap}
     */
    private function extractProperties(\Dom\Element $subjectNode, HtmlSourceLocator $locator): array
    {
        $occurrences = [];

        // Properties are read in document order. Schema.org subjects that don't
        // have a property attribute are not descended into (property+typeof
        // nodes are, their nested subjects being extracted below).
        $propertyNodes = self::collectInDocumentOrder(
            $subjectNode,
            static fn (\Dom\Element $node): bool => $node->hasAttribute('property'),
            fn (\Dom\Element $node): bool => $this->isSchemaOrgSubject($node) && !$node->hasAttribute('property'),
        );

        foreach ($propertyNodes as $propertyNode) {
            $propertyNames = $this->termResolver->resolveTerms($propertyNode->getAttribute('property') ?? '', $propertyNode);

            if ([] === $propertyNames) {
                continue;
            }

            if ($propertyNode->hasAttribute('typeof')) {
                $extracted = $this->extractSubject($propertyNode, $locator);

                if (null === $extracted) {
                    continue;
                }

                [$value, $valueSourceMap] = $extracted;
            } else {
                $extracted = $this->extractPropertyValue($propertyNode);

                if (null === $extracted) {
                    continue;
                }

                [$value, $sourceAttribute] = $extracted;
                $valueSourceMap = new SourceMap();
                $valueSourceMap->setValue('', (null === $sourceAttribute
                    ? $locator->text($propertyNode)
                    : $locator->attributeValue($propertyNode, $sourceAttribute)) ?? self::anchorOf($locator, $propertyNode));
            }

            $nameTokens = $this->termTokenIndexes($propertyNode, 'property');

            foreach ($propertyNames as $propertyName) {
                $occurrences[$propertyName][] = [
                    'value' => $value,
                    'map' => $valueSourceMap,
                    'key' => $locator->attributeToken($propertyNode, 'property', $nameTokens[$propertyName] ?? -1) ?? self::anchorOf($locator, $propertyNode),
                ];
            }
        }

        return self::buildProperties($occurrences);
    }

    /**
     * Tells which token of an attribute each schema.org term it resolves to is
     * written as: "name" is the second token of property="og:title schema:name".
     *
     * @return array<string, int> the index of the first token resolving to each term
     */
    private function termTokenIndexes(\Dom\Element $element, string $attribute): array
    {
        $indexes = [];
        $tokens = preg_split('/\s+/', trim($element->getAttribute($attribute) ?? '')) ?: [];

        foreach ($tokens as $index => $token) {
            foreach ($this->termResolver->resolveTerms($token, $element) as $term) {
                $indexes[$term] ??= $index;
            }
        }

        return $indexes;
    }

    /**
     * @return array{string, string}|null the identifier, and the attribute it was read from
     */
    private function extractSubjectIdentifier(\Dom\Element $subjectNode): ?array
    {
        foreach (['about', 'resource', 'href', 'src'] as $attribute) {
            if ($subjectNode->hasAttribute($attribute)) {
                $value = trim($subjectNode->getAttribute($attribute) ?? '');

                if ('' !== $value) {
                    return [$value, $attribute];
                }
            }
        }

        return null;
    }

    /**
     * Reads the value of a property element, and names the attribute it was read
     * from (null when it is the text of the element).
     *
     * @return array{string, ?string}|null
     */
    private function extractPropertyValue(\Dom\Element $propertyNode): ?array
    {
        foreach (['content', 'resource', 'href', 'src', 'datetime', 'value'] as $attribute) {
            if ($propertyNode->hasAttribute($attribute)) {
                $value = trim($propertyNode->getAttribute($attribute) ?? '');

                if ('' !== $value) {
                    return [$value, $attribute];
                }
            }
        }

        $normalizedText = preg_replace('/\s+/u', ' ', $propertyNode->textContent ?? '');

        if (!\is_string($normalizedText)) {
            return null;
        }

        $text = trim($normalizedText);

        return '' === $text ? null : [$text, null];
    }

    private function resetMemoization(): void
    {
        $this->termResolver->reset();
        $this->schemaOrgCandidateCache = [];
        $this->schemaOrgSubjectCache = [];
    }
}
