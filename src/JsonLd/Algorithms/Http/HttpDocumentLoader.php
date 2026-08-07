<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\Http;

use Jolicode\JsonLd\Algorithms\Exception\ContextProcessingException;
use Jolicode\JsonLd\Algorithms\JsonLd\Keyword;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Fetches remote documents over HTTP, within the boundaries of a RemoteContextPolicy.
 *
 * The policy is enforced on every URL that is about to be requested: the one asked
 * for, every alternate location, every "Link" header hop, and the effective URL the
 * response was ultimately served from. Anything else would let a single redirect walk
 * out of the allow-list.
 */
class HttpDocumentLoader implements DocumentLoaderInterface
{
    private readonly RemoteContextPolicy $policy;
    private readonly HttpClientInterface $httpClient;

    public function __construct(
        ?RemoteContextPolicy $policy = null,
        ?HttpClientInterface $httpClient = null,
    ) {
        $this->policy = $policy ?? RemoteContextPolicy::schemaOrgOnly();
        $this->httpClient = $httpClient ?? HttpClient::create();
    }

    public function load(string $url): \stdClass
    {
        return $this->doLoad($url, 1);
    }

    public function getCacheNamespace(): string
    {
        return 'http:' . $this->policy->fingerprint();
    }

    private function doLoad(string $url, int $hop): \stdClass
    {
        if ($hop > $this->policy->maxHops) {
            throw new ContextProcessingException('loading remote context failed');
        }

        if (!$this->policy->allows($url)) {
            throw new ContextProcessingException('loading remote context failed');
        }

        try {
            $response = $this->httpClient->request('GET', $url, [
                'headers' => [
                    'Accept' => 'application/ld+json,application/json,*/*;q=0.1',
                    'User-Agent' => 'Mozilla/5.0 (compatible; redirection-io/1.0; +https://redirection.io/)',
                ],
                'timeout' => $this->policy->timeout,
                'max_duration' => $this->policy->maxDuration,
                'max_redirects' => $this->policy->maxRedirects,
            ]);

            $statusCode = $response->getStatusCode();
            $headers = $response->getHeaders(throw: false);
        } catch (ExceptionInterface) {
            throw new ContextProcessingException('loading remote context failed');
        }

        // Redirects have been followed by now, so re-check where we actually landed.
        $effectiveUrl = $response->getInfo('url');

        if (\is_string($effectiveUrl) && !$this->policy->allows($effectiveUrl)) {
            $response->cancel();

            throw new ContextProcessingException('loading remote context failed');
        }

        if (400 <= $statusCode) {
            $response->cancel();

            // Deliberately opaque: the response body of a remote host must never
            // travel back to the caller, who may well be the one who chose the URL.
            throw new ContextProcessingException('loading remote context failed');
        }

        $contentType = $headers['content-type'][0] ?? '';
        $externalContextNode = null;

        if ('application/ld+json' !== $contentType) {
            $parsedLinkHeaders = $this->parseLinkHeaders($headers['link'] ?? []);

            if ($parsedLinkHeaders) {
                // try to see at an alternate location https://www.w3.org/TR/json-ld/#alternate-document-location
                $alternateLocationHeader = array_values(array_filter($parsedLinkHeaders, static function ($link) {
                    return isset($link['rel'])
                        && isset($link['type'])
                        && \in_array('alternate', explode(' ', $link['rel']), true)
                        && 'application/ld+json' === $link['type'];
                }));

                if (\count($alternateLocationHeader) > 1) {
                    // exception, see spec:
                    // A response MUST NOT contain more than one HTTP Link Header using the alternate link relation with type="application/ld+json".
                    $response->cancel();

                    throw new \LogicException('A response MUST NOT contain more than one HTTP Link Header using the alternate link relation with type="application/ld+json".');
                } elseif (1 === \count($alternateLocationHeader)) {
                    $response->cancel();

                    return $this->doLoad(
                        IriResolver::resolveIri($url, $alternateLocationHeader[0]['uri']),
                        $hop + 1,
                    );
                }

                if (
                    'application/json' === $contentType
                    || '+json' === substr($contentType, -5)
                ) {
                    // check for a Link rel="http://www.w3.org/ns/json-ld#context"
                    // see https://www.w3.org/TR/json-ld/#interpreting-json-as-json-ld
                    // if found, get the context at this URL
                    $externalContextURLs = array_values(array_filter($parsedLinkHeaders, static function ($link) {
                        return isset($link['rel'])
                            && \in_array('http://www.w3.org/ns/json-ld#context', explode(' ', $link['rel']), true);
                    }));

                    if (\count($externalContextURLs) > 1) {
                        // exception, see spec:
                        // A response MUST NOT contain more than one HTTP Link Header using the http://www.w3.org/ns/json-ld#context link relation.
                        $response->cancel();

                        throw new \LogicException('A response MUST NOT contain more than one HTTP Link Header using the http://www.w3.org/ns/json-ld#context link relation.');
                    } elseif (1 === \count($externalContextURLs)) {
                        // inject this context
                        $externalContextNode = $this->doLoad(
                            IriResolver::resolveIri($externalContextURLs[0]['uri'], $url),
                            $hop + 1,
                        );

                        if (isset($externalContextNode->{Keyword::CONTEXT->value}[Keyword::BASE->value])) {
                            // see https://www.w3.org/TR/json-ld/#base-iri
                            // Please note that the @base will be ignored if used in external contexts.
                            unset($externalContextNode->{Keyword::CONTEXT->value}[Keyword::BASE->value]);
                        }
                    }
                }
            }
        }

        $document = json_decode($this->readBoundedContent($response));

        if (!\is_array($document) && !$document instanceof \stdClass) {
            throw new ContextProcessingException('loading remote context failed');
        }

        if (\is_array($document)) {
            $document = (object) $document;
        }

        if (null !== $externalContextNode) {
            if (property_exists($document, Keyword::CONTEXT->value)) {
                $document->{Keyword::CONTEXT->value} = $externalContextNode->{Keyword::CONTEXT->value};
            } else {
                foreach ($document as $key => $node) {
                    if (\is_array($node)) {
                        $document->$key->{Keyword::CONTEXT->value} = $externalContextNode->{Keyword::CONTEXT->value};
                    }
                }
            }
        }

        return $document;
    }

    /**
     * Streams the response so that an oversized body is cut off instead of being
     * buffered whole.
     */
    private function readBoundedContent(ResponseInterface $response): string
    {
        $content = '';

        try {
            foreach ($this->httpClient->stream($response) as $chunk) {
                $content .= $chunk->getContent();

                if (\strlen($content) > $this->policy->maxResponseBytes) {
                    $response->cancel();

                    throw new ContextProcessingException('loading remote context failed');
                }
            }
        } catch (ExceptionInterface) {
            throw new ContextProcessingException('loading remote context failed');
        }

        return $content;
    }

    /**
     * @param array<string> $headers
     *
     * @return array<array<string, string>>
     */
    private function parseLinkHeaders(array $headers): array
    {
        $parsed = [];

        foreach ($headers as $key => $header) {
            if (str_contains($header, ',')) {
                $parts = preg_split('/,(?=\s*<.*>([^"]*"[^"]*")*[^"]*$)/', $header);

                if (false === $parts) {
                    throw new \RuntimeException('Failed to parse Link header');
                }

                foreach ($parts as $part) {
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
                    $parts = preg_split('/;(?=([^"]*"[^"]*")*[^"]*$)/', $matches[2]);

                    if (false === $parts) {
                        throw new \RuntimeException('Failed to parse header');
                    }

                    foreach ($parts as $part) {
                        $parts = preg_split('/=(?=([^"]*"[^"]*")*$)/', $part);

                        if (false !== $parts) {
                            $item[trim($parts[0])] = trim($parts[1], "\s\"'");
                        }
                    }
                }

                $parsed[] = $item;
            }
        }

        return $parsed;
    }
}
