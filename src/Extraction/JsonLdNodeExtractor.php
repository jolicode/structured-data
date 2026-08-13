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

class JsonLdNodeExtractor extends AbstractHtmlExtractor
{
    public function getFormat(): ExtractorFormat
    {
        return ExtractorFormat::JSONLD;
    }

    /**
     * @return JsonLdElement[]
     */
    public function extractStructuredDataContent(string $body): array
    {
        $trimmedBody = trim($body);

        if ($this->looksLikeRawJsonDocument($trimmedBody)) {
            // Let the parser report precise syntax errors for raw JSON input.
            return [new JsonLdElement(0, 0, $body, $this->getFormat())];
        }

        [$content, $invalidLineNumbers] = $this->extractJsonLdNodes($body);

        if ($content) {
            return $content;
        }

        if ($this->containsJsonLdScriptTag($body)) {
            $locationInfo = $this->formatLineHint($invalidLineNumbers);

            throw new ExtractionException(\sprintf('Invalid JSON-LD document: found JSON-LD script tags but could not extract usable content%s.', $locationInfo), $this->formatRanges($invalidLineNumbers));
        }

        return [];
    }

    public function supportsContent(string $body): bool
    {
        $trimmedBody = trim($body);

        if ($this->looksLikeRawJsonDocument($trimmedBody)) {
            return true;
        }

        return $this->containsJsonLdScriptTag($body);
    }

    /**
     * @return array{array<JsonLdElement>, list<int>}
     */
    private function extractJsonLdNodes(string $body): array
    {
        $content = [];
        $invalidLineNumbers = [];

        if (preg_match_all(
            '/<script[^>]+type=[\"\']application\/ld\+json[\"\'][^>]*>(.*)<\/script>/miUus',
            $body,
            $matches,
            \PREG_PATTERN_ORDER | \PREG_OFFSET_CAPTURE,
        )) {
            foreach ($matches[1] as $match) {
                $bodyPrefix = substr($body, 0, $match[1]);

                if (!json_validate(trim($match[0]))) {
                    $lineNumber = substr_count($bodyPrefix, "\n") + 1;
                    $invalidLineNumbers[] = $lineNumber;

                    continue;
                }

                $startLine = substr_count($bodyPrefix, "\n");

                if (0 === $startLine) {
                    $startColumn = mb_strlen($bodyPrefix);
                } else {
                    $lastLineReturnPosition = strrpos($bodyPrefix, "\n");
                    $startColumn = false === $lastLineReturnPosition
                        ? mb_strlen($bodyPrefix)
                        : mb_strlen(substr($bodyPrefix, $lastLineReturnPosition + 1));
                }

                $jsonLdElement = new JsonLdElement($startLine, $startColumn, $match[0], $this->getFormat());
                $content[] = $jsonLdElement;
            }
        }

        return [$content, $invalidLineNumbers];
    }

    private function looksLikeRawJsonDocument(string $trimmedBody): bool
    {
        if ('' === $trimmedBody || !\in_array($trimmedBody[0], ['[', '{'], true)) {
            return false;
        }

        // Avoid classifying HTML documents (including malformed ones) as raw JSON.
        // Quick precheck: look for common HTML tag starts before expensive regex
        if (!str_contains($trimmedBody, '<')) {
            return true;
        }

        return 1 !== preg_match('/<\s*(?:!doctype|html|head|body|script|meta|div|span|section|article|main)\b/i', $trimmedBody);
    }

    private function containsJsonLdScriptTag(string $body): bool
    {
        if (!str_contains($body, 'application/ld+json')) {
            return false;
        }

        return 1 === preg_match('/<script[^>]+type=["\']application\/ld\+json["\'][^>]*>/miu', $body);
    }
}
