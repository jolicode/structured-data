<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Extraction;

class RdfaExtractor extends AbstractHtmlExtractor
{
    public function supportsContent(string $body): bool
    {
        return $this->containsSchemaOrgMarkers($body);
    }

    /**
     * @return JsonLdElement[]
     */
    public function extractStructuredDataContent(string $body): array
    {
        if (!$this->supportsContent($body)) {
            return [];
        }

        $document = $this->loadDocument($body);
        $xpath = new \DOMXPath($document);
        $typedNodes = $xpath->query('//*[@typeof]');

        if (false === $typedNodes) {
            throw new \RuntimeException('Invalid RDFa document: could not query the HTML document.');
        }

        $topLevelSubjects = [];

        foreach ($typedNodes as $typedNode) {
            if (!$typedNode instanceof \DOMElement) {
                continue;
            }

            if (!$this->isSchemaOrgSubject($typedNode)) {
                continue;
            }

            if (!$this->hasAncestorSchemaOrgSubject($typedNode)) {
                $topLevelSubjects[] = $typedNode;
            }
        }

        if ([] === $topLevelSubjects) {
            $candidateNodes = $xpath->query('//*[@typeof or @property or @vocab or @prefix or @about or @resource]');
            $candidateLines = [];

            if (false !== $candidateNodes) {
                foreach ($candidateNodes as $candidateNode) {
                    if (!$candidateNode instanceof \DOMElement) {
                        continue;
                    }

                    if ($this->isSchemaOrgCandidate($candidateNode)) {
                        $candidateLines[] = $candidateNode->getLineNo();
                    }
                }
            }

            throw new \RuntimeException(\sprintf('Invalid RDFa document: at least one top-level schema.org subject with typeof is required%s.', $this->formatLineHint($candidateLines)));
        }

        $elements = [];

        foreach ($topLevelSubjects as $subjectNode) {
            $item = $this->extractSubject($subjectNode, $xpath);

            if (null === $item) {
                continue;
            }

            $encoded = json_encode($item, \JSON_UNESCAPED_SLASHES);

            if (false === $encoded) {
                throw new \RuntimeException('Invalid RDFa document: failed to convert to JSON-LD.');
            }

            $elements[] = new JsonLdElement(max(0, $subjectNode->getLineNo() - 1), 0, $encoded);
        }

        if ([] === $elements) {
            $subjectLines = array_map(static fn (\DOMElement $subjectNode): int => $subjectNode->getLineNo(), $topLevelSubjects);

            throw new \RuntimeException(\sprintf('Invalid RDFa document: at least one top-level schema.org subject with typeof is required%s.', $this->formatLineHint($subjectLines)));
        }

        return $elements;
    }

    protected function getFormatName(): string
    {
        return 'RDFa';
    }

    private function containsSchemaOrgMarkers(string $body): bool
    {
        $document = $this->loadDocument($body);
        $xpath = new \DOMXPath($document);
        $nodes = $xpath->query('//*[@typeof or @property or @vocab or @prefix or @about or @resource]');

        if (false === $nodes) {
            return false;
        }

        foreach ($nodes as $node) {
            if (!$node instanceof \DOMElement) {
                continue;
            }

            if ($this->isSchemaOrgCandidate($node)) {
                return true;
            }
        }

        return false;
    }

    private function isSchemaOrgCandidate(\DOMElement $element): bool
    {
        if ($this->isSchemaOrgVocab($this->resolveVocab($element))) {
            return true;
        }

        if ([] !== $this->resolveTerms($element->getAttribute('typeof'), $element)) {
            return true;
        }

        return [] !== $this->resolveTerms($element->getAttribute('property'), $element);
    }

    private function isSchemaOrgSubject(\DOMElement $element): bool
    {
        return [] !== $this->resolveTerms($element->getAttribute('typeof'), $element);
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
    private function extractSubject(\DOMElement $subjectNode, \DOMXPath $xpath): ?array
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

        foreach ($this->extractProperties($subjectNode, $xpath) as $propertyName => $value) {
            $item[$propertyName] = $value;
        }

        return $item;
    }

    /**
     * @return array<string, mixed>
     */
    private function extractProperties(\DOMElement $subjectNode, \DOMXPath $xpath): array
    {
        $properties = [];
        $propertyNodes = $xpath->query('.//*[@property]', $subjectNode);

        if (false === $propertyNodes) {
            return $properties;
        }

        foreach ($propertyNodes as $propertyNode) {
            if (!$propertyNode instanceof \DOMElement) {
                continue;
            }

            if (!$this->belongsToSubject($propertyNode, $subjectNode)) {
                continue;
            }

            $propertyNames = $this->resolveTerms($propertyNode->getAttribute('property'), $propertyNode);

            if ([] === $propertyNames) {
                continue;
            }

            $value = $propertyNode->hasAttribute('typeof')
                ? $this->extractSubject($propertyNode, $xpath)
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

    private function belongsToSubject(\DOMElement $propertyNode, \DOMElement $subjectNode): bool
    {
        $parent = $propertyNode->parentNode;

        while ($parent instanceof \DOMElement) {
            if ($parent->isSameNode($subjectNode)) {
                return true;
            }

            if ($this->isSchemaOrgSubject($parent)) {
                return false;
            }

            $parent = $parent->parentNode;
        }

        return false;
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
        $tokens = preg_split('/\s+/', trim($attributeValue)) ?: [];
        $resolvedTerms = [];

        foreach ($tokens as $token) {
            $resolvedTerm = $this->resolveTerm($token, $contextElement);

            if (null === $resolvedTerm) {
                continue;
            }

            $resolvedTerms[$resolvedTerm] = $resolvedTerm;
        }

        return array_values($resolvedTerms);
    }

    private function resolveTerm(string $token, \DOMElement $contextElement): ?string
    {
        $token = trim($token);

        if ('' === $token) {
            return null;
        }

        if (preg_match('~^https?://schema\.org/([^\s#/]+)$~', $token, $matches)) {
            return $matches[1];
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
        $element = $contextElement;

        while ($element instanceof \DOMElement) {
            if ($element->hasAttribute('vocab')) {
                return trim($element->getAttribute('vocab'));
            }

            $parent = $element->parentNode;
            $element = $parent instanceof \DOMElement ? $parent : null;
        }

        return null;
    }

    /**
     * @return array<string, string>
     */
    private function resolvePrefixMappings(\DOMElement $contextElement): array
    {
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

        return $prefixes;
    }

    private function isSchemaOrgVocab(?string $vocab): bool
    {
        return \in_array($vocab, ['http://schema.org/', 'https://schema.org/'], true);
    }
}
