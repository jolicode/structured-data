<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Extraction;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class JsonLdNodeExtractor
{
    public function __construct(
        private ?HttpClientInterface $httpClient = null,
    ) {
        $this->httpClient = $httpClient ?? HttpClient::create();
    }

    public function extractJsonLd(string $url): array
    {
        $response = $this->httpClient->request('GET', $url, [
            'headers' => [
                'Accept' => 'application/ld+json',
            ],
        ]);

        return $this->extractStructuredDataContent($response->getContent());
    }

    public function extractStructuredDataContent(string $body): array
    {
        $content = $this->extractJsonLdNodes($body);

        if (0 === \count($content)) {
            if (\in_array(substr(trim($body), 0, 1), ['[', '{'], true)) {
                // assume it is a json string
                $content = [$body];
            }
        }

        return $content;
    }

    private function extractJsonLdNodes(string $body): array
    {
        $content = [];
        $document = JsonLdDOMDocument::fromString($body);

        foreach ($document->getItems() as $item) {
            $content[] = $item->textContent;
        }

        return $content;
    }
}
