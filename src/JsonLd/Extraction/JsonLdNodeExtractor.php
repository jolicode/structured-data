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

class JsonLdNodeExtractor implements FormatExtractorInterface
{
    /**
     * @return JsonLdElement[]
     */
    public function extractStructuredDataContent(string $body): array
    {
        $trimmedBody = trim($body);

        if ($this->looksLikeRawJsonDocument($trimmedBody)) {
            // Let the parser report precise syntax errors for raw JSON input.
            return [new JsonLdElement(0, 0, $body)];
        }

        [$content, $invalidLocations] = $this->extractJsonLdNodes($body);

        if ($content) {
            return $content;
        }

        if ($this->containsJsonLdScriptTag($body)) {
            $locationInfo = $invalidLocations ? ' at ' . implode(', ', $invalidLocations) : '';

            throw new \RuntimeException(\sprintf('Invalid JSON-LD document: found JSON-LD script tags but could not extract usable content%s.', $locationInfo));
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
     * @return array{array<JsonLdElement>, list<string>}
     */
    private function extractJsonLdNodes(string $body): array
    {
        $content = [];
        $invalidLocations = [];

        if (preg_match_all(
            '/<script[^>]+type=[\"\']application\/ld\+json[\"\'][^>]*>(.*)<\/script>/miUus',
            $body,
            $matches,
            \PREG_PATTERN_ORDER | \PREG_OFFSET_CAPTURE,
        )) {
            foreach ($matches[1] as $match) {
                if (!json_validate(trim($match[0]))) {
                    $lineNumber = substr_count(substr($body, 0, $match[1]), "\n") + 1;
                    $invalidLocations[] = "line {$lineNumber}";

                    continue;
                }

                $startColumn = mb_strlen(substr($body, 0, $match[1]));
                $startLine = substr_count(mb_substr($body, 0, $startColumn), "\n");

                if ($startLine > 0) {
                    $lastLineReturnPosition = mb_strrpos(mb_substr($body, 0, $startColumn), "\n");

                    if (false !== $lastLineReturnPosition) {
                        $startColumn = $startColumn - $lastLineReturnPosition - 1;
                    }
                }

                $jsonLdElement = new JsonLdElement($startLine, $startColumn, $match[0]);
                $content[] = $jsonLdElement;
            }
        }

        return [$content, $invalidLocations];
    }

    private function looksLikeRawJsonDocument(string $trimmedBody): bool
    {
        if ('' === $trimmedBody || !\in_array($trimmedBody[0], ['[', '{'], true)) {
            return false;
        }

        // Avoid classifying HTML documents (including malformed ones) as raw JSON.
        return 1 !== preg_match('/<\s*(?:!doctype|html|head|body|script|meta|div|span|section|article|main)\b/i', $trimmedBody);
    }

    private function containsJsonLdScriptTag(string $body): bool
    {
        return 1 === preg_match('/<script[^>]+type=["\']application\/ld\+json["\'][^>]*>/miu', $body);
    }
}
