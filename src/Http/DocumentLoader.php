<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Http;

use Jolicode\JsonLd\JsonLd\Keyword;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class DocumentLoader
{
    private const MAX_DOCUMENTS = 10;

    private int $documentsCount = 0;
    private HttpClientInterface $httpClient;

    public function __construct(
        private string $url
    ) {
        $this->httpClient = HttpClient::create();
    }

    public function load(): \stdClass
    {
        ++$this->documentsCount;

        if ($this->documentsCount > self::MAX_DOCUMENTS) {
            throw new \LogicException(sprintf('Cannot load more than %s documents.', self::MAX_DOCUMENTS));
        }

        if (is_file($this->url)) {
            return (array) file_get_contents($this->url);
        }

        $response = $this->httpClient->request(
            'GET',
            $this->url,
            [
                'headers' => [
                    'Accept' => 'application/ld+json,application/json,*/*;q=0.1',
                    'User-Agent' => 'Mozilla/5.0 (compatible; redirection-io/1.0; +https://redirection.io/)',
                ],
            ]
        );

        if (400 <= $response->getStatusCode()) {
            return [Keyword::CONTEXT->value => null];
        }

        if ('application/ld+json' !== $response->getHeaders()['content-type'][0]) {
            if (\array_key_exists('link', $response->getHeaders()) && \count($response->getHeaders()['link']) > 0) {
                $parsedLinkHeaders = $this->parseLinkHeaders($response->getHeaders()['link']);

                // try to see at an alternate location https://www.w3.org/TR/json-ld/#alternate-document-location
                $alternateLocationHeader = array_filter($parsedLinkHeaders, function ($link) {
                    return isset($link['rel'])
                        && isset($link['type'])
                        && \in_array('alternate', explode(' ', $link['rel']), true)
                        && 'application/ld+json' === $link['type'];
                });

                if (\count($alternateLocationHeader) > 1) {
                    // exception, see spec:
                    // A response MUST NOT contain more than one HTTP Link Header using the alternate link relation with type="application/ld+json".
                    throw new \LogicException('A response MUST NOT contain more than one HTTP Link Header using the alternate link relation with type="application/ld+json".');
                } elseif (1 === \count($alternateLocationHeader)) {
                    $this->url = IriResolver::resolveIri(
                        $this->url,
                        $alternateLocationHeader[0]['uri'],
                    );

                    return $this->load();
                }

                if (
                    'application/json' === $response->getHeaders()['content-type']
                    || '+json' === substr($response->getHeaders()['content-type'][0], -5)
                ) {
                    // check for a Link rel="http://www.w3.org/ns/json-ld#context"
                    // see https://www.w3.org/TR/json-ld/#interpreting-json-as-json-ld
                    // if found, get the context at this URL
                    $externalContextURLs = array_filter($parsedLinkHeaders, function ($link) {
                        return isset($link['rel'])
                            && \in_array('http://www.w3.org/ns/json-ld#context', explode(' ', $link['rel']), true);
                    });

                    if (\count($externalContextURLs) > 1) {
                        // exception, see spec:
                        // A response MUST NOT contain more than one HTTP Link Header using the http://www.w3.org/ns/json-ld#context link relation.
                        throw new \LogicException('A response MUST NOT contain more than one HTTP Link Header using the http://www.w3.org/ns/json-ld#context link relation.');
                    } elseif (1 === \count($externalContextURLs)) {
                        $this->url = IriResolver::resolveIri(
                            $externalContextURLs[0]['uri'],
                            $this->url
                        );
                        // inject this context
                        $externalContextNode = $this->load();

                        if (isset($externalContextNode[Keyword::CONTEXT->value][Keyword::BASE->value])) {
                            // see https://www.w3.org/TR/json-ld/#base-iri
                            // Please note that the @base will be ignored if used in external contexts.
                            unset($externalContextNode[Keyword::CONTEXT->value][Keyword::BASE->value]);
                        }
                    }
                }
            }
        }

        $response = json_decode($response->getContent());

        if (isset($externalContextNode)) {
            if (property_exists($response, Keyword::CONTEXT->value)) {
                $response->{Keyword::CONTEXT->value} = $externalContextNode[Keyword::CONTEXT->value];
            } else {
                foreach ($response as $key => $node) {
                    if (\is_array($node)) {
                        $response->$key->{Keyword::CONTEXT->value} = $externalContextNode[Keyword::CONTEXT->value];
                    }
                }
            }
        }

        return $response;
    }

    private function parseLinkHeaders(array $headers): array
    {
        $parsed = [];

        foreach ($headers as $key => $header) {
            if (false !== strpos($header, ',')) {
                foreach (preg_split('/,(?=\s*<.*>([^"]*"[^"]*")*[^"]*$)/', $header) as $part) {
                    $headers[] = trim($part);
                }

                unset($headers[$key]);
            }
        }

        foreach ($headers as $header) {
            if (preg_match('/^<([^>]*)>(?:\s?;\s?(.+))?$/', trim($header), $matches)) {
                $item = [
                    'uri' => $matches[1],
                ];

                if (isset($matches[2])) {
                    foreach (preg_split('/;(?=([^"]*"[^"]*")*[^"]*$)/', $matches[2]) as $part) {
                        $parts = preg_split('/=(?=([^"]*"[^"]*")*$)/', $part);
                        $item[trim($parts[0])] = trim($parts[1], "\s\"'");
                    }
                }

                $parsed[] = $item;
            }
        }

        return $parsed;
    }
}
