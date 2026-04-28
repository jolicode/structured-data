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

class MicrodataExtractor extends AbstractHtmlExtractor
{
    public function supportsContent(string $body): bool
    {
        return str_contains($body, 'itemscope')
            || str_contains($body, 'itemtype')
            || str_contains($body, 'itemprop');
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
        $allItemScopes = $xpath->query('//*[@itemscope]');

        if (false === $allItemScopes) {
            throw new \RuntimeException('Invalid microdata document: could not query the HTML document.');
        }

        if (0 === $allItemScopes->count()) {
            $candidateNodes = $xpath->query('//*[@itemtype or @itemprop]');
            $candidateLines = [];

            if (false !== $candidateNodes) {
                foreach ($candidateNodes as $candidateNode) {
                    if ($candidateNode instanceof \DOMElement) {
                        $candidateLines[] = $candidateNode->getLineNo();
                    }
                }
            }

            throw new \RuntimeException(\sprintf('Invalid microdata document: found microdata attributes but no itemscope attribute%s.', $this->formatLineHint($candidateLines)));
        }

        $topLevelItems = [];

        foreach ($allItemScopes as $itemScope) {
            if (!$itemScope instanceof \DOMElement) {
                continue;
            }

            if (!$this->hasAncestorItemScope($itemScope)) {
                $topLevelItems[] = $itemScope;
            }
        }

        if ([] === $topLevelItems) {
            return [];
        }

        $elements = [];

        foreach ($topLevelItems as $itemElement) {
            $item = $this->extractItem($itemElement, $xpath);

            if (null === $item) {
                continue;
            }

            $encoded = json_encode($item, \JSON_UNESCAPED_SLASHES);

            if (false === $encoded) {
                throw new \RuntimeException('Invalid microdata document: failed to convert to JSON-LD.');
            }

            $elements[] = new JsonLdElement(max(0, $itemElement->getLineNo() - 1), 0, $encoded);
        }

        if ([] === $elements) {
            $itemScopeLines = array_map(static fn (\DOMElement $itemElement): int => $itemElement->getLineNo(), $topLevelItems);

            throw new \RuntimeException(\sprintf('Invalid microdata document: at least one top-level itemscope with itemtype is required%s.', $this->formatLineHint($itemScopeLines)));
        }

        return $elements;
    }

    protected function getFormatName(): string
    {
        return 'microdata';
    }

    private function hasAncestorItemScope(\DOMElement $element): bool
    {
        $parent = $element->parentNode;

        while ($parent instanceof \DOMElement) {
            if ($parent->hasAttribute('itemscope')) {
                return true;
            }

            $parent = $parent->parentNode;
        }

        return false;
    }

    /**
     * @return array<string, mixed>|null
     */
    private function extractItem(\DOMElement $itemElement, \DOMXPath $xpath): ?array
    {
        $itemTypeAttribute = trim($itemElement->getAttribute('itemtype'));

        if ('' === $itemTypeAttribute) {
            return null;
        }

        $typeName = $this->normalizeItemType($itemTypeAttribute);

        $item = [
            '@context' => 'https://schema.org',
            '@type' => $typeName,
        ];

        if ($itemElement->hasAttribute('itemid')) {
            $item['@id'] = trim($itemElement->getAttribute('itemid'));
        }

        $properties = $this->extractProperties($itemElement, $xpath);

        foreach ($properties as $propertyKey => $value) {
            $item[$propertyKey] = $value;
        }

        return $item;
    }

    private function normalizeItemType(string $itemType): string
    {
        $itemType = trim($itemType);

        if (str_contains($itemType, '/')) {
            $segments = preg_split('~[\\/#]~', $itemType);

            if (\is_array($segments)) {
                $lastSegment = (string) end($segments);

                if ('' !== $lastSegment) {
                    return $lastSegment;
                }
            }
        }

        return $itemType;
    }

    /**
     * @return array<string, mixed>
     */
    private function extractProperties(\DOMElement $itemElement, \DOMXPath $xpath): array
    {
        $properties = [];
        $propertyNodes = $xpath->query('.//*[@itemprop]', $itemElement);

        if (false === $propertyNodes) {
            return $properties;
        }

        foreach ($propertyNodes as $propertyNode) {
            if (!$propertyNode instanceof \DOMElement) {
                continue;
            }

            if (!$this->belongsToItem($propertyNode, $itemElement)) {
                continue;
            }

            $propertyNames = preg_split('/\s+/', trim($propertyNode->getAttribute('itemprop')));

            if (!\is_array($propertyNames)) {
                continue;
            }

            $value = $propertyNode->hasAttribute('itemscope')
                ? $this->extractItem($propertyNode, $xpath)
                : $this->extractPropertyValue($propertyNode);

            if (null === $value) {
                continue;
            }

            foreach ($propertyNames as $propertyName) {
                if ('' === $propertyName) {
                    continue;
                }

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

    private function belongsToItem(\DOMElement $propertyNode, \DOMElement $itemElement): bool
    {
        $parent = $propertyNode->parentNode;

        while ($parent instanceof \DOMElement) {
            if ($parent->hasAttribute('itemscope')) {
                return $parent->isSameNode($itemElement);
            }

            $parent = $parent->parentNode;
        }

        return false;
    }

    private function extractPropertyValue(\DOMElement $propertyNode): ?string
    {
        $tagName = strtolower($propertyNode->tagName);

        if ('meta' === $tagName && $propertyNode->hasAttribute('content')) {
            return trim($propertyNode->getAttribute('content'));
        }

        if (\in_array($tagName, ['audio', 'embed', 'iframe', 'img', 'source', 'track', 'video'], true) && $propertyNode->hasAttribute('src')) {
            return trim($propertyNode->getAttribute('src'));
        }

        if (\in_array($tagName, ['a', 'area', 'link'], true) && $propertyNode->hasAttribute('href')) {
            return trim($propertyNode->getAttribute('href'));
        }

        if ('object' === $tagName && $propertyNode->hasAttribute('data')) {
            return trim($propertyNode->getAttribute('data'));
        }

        if (\in_array($tagName, ['data', 'meter'], true) && $propertyNode->hasAttribute('value')) {
            return trim($propertyNode->getAttribute('value'));
        }

        if ('time' === $tagName && $propertyNode->hasAttribute('datetime')) {
            return trim($propertyNode->getAttribute('datetime'));
        }

        $text = trim($propertyNode->textContent);

        return '' === $text ? null : $text;
    }
}
