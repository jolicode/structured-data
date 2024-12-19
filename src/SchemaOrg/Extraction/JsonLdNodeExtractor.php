<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Extraction;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class JsonLdNodeExtractor
{
    private HttpClientInterface $httpClient;

    public function __construct(
        ?HttpClientInterface $httpClient = null,
    ) {
        $this->httpClient = $httpClient ?? HttpClient::create();
    }

    /**
     * @return JsonLdElement[]
     */
    public function extractJsonLd(string $url): array
    {
        $response = $this->httpClient->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/ld+json',
            ],
        ]);

        return $this->extractStructuredDataContent($response->getContent());
    }

    /**
     * @return JsonLdElement[]
     */
    public function extractStructuredDataContent(string $body): array
    {
        $content = $this->extractJsonLdNodes($body);

        if (0 === \count($content)) {
            if (\in_array(substr(trim($body), 0, 1), ['[', '{'], true)) {
                // assume it is a json string
                $content = [new JsonLdElement(0, 0, $body)];
            }
        }

        return $content;
    }

    /**
     * @return JsonLdElement[]
     */
    private function extractJsonLdNodes(string $body): array
    {
        $content = [];

        if (preg_match_all(
            '/<script[^>]+type=[\"\']application\/ld\+json[\"\'][^>]*>(.*)<\/script>/miUus',
            $body,
            $matches,
            \PREG_PATTERN_ORDER | \PREG_OFFSET_CAPTURE,
        )) {
            foreach ($matches[1] as $match) {
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

        return $content;
    }
}
