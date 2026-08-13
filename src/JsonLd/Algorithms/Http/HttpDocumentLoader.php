<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Http;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ContextProcessingException;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\Keyword;
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
    private ?HttpClientInterface $httpClient;

    public function __construct(
        ?RemoteContextPolicy $policy = null,
        ?HttpClientInterface $httpClient = null,
    ) {
        $this->policy = $policy ?? RemoteContextPolicy::schemaOrgOnly();
        // The client is created lazily: the default policy refuses every host and
        // never reaches a request, so an application that only relies on the
        // bundled schema.org context needs no HTTP client (and no symfony/http-client)
        // at all.
        $this->httpClient = $httpClient;
    }

    public function load(string $url): \stdClass
    {
        return $this->doLoad($url, 1);
    }

    public function getCacheNamespace(): string
    {
        return 'http:' . $this->policy->fingerprint();
    }

    /**
     * Resolves the HTTP client lazily, so symfony/http-client is only required once
     * a request is actually about to be issued.
     */
    private function httpClient(): HttpClientInterface
    {
        if (null === $this->httpClient) {
            if (!class_exists(HttpClient::class)) {
                throw new \LogicException(\sprintf('Loading a remote context requires an HTTP client. Install symfony/http-client ("composer require symfony/http-client"), or pass your own %s to %s.', HttpClientInterface::class, self::class));
            }

            $this->httpClient = HttpClient::create();
        }

        return $this->httpClient;
    }

    private function doLoad(string $url, int $hop): \stdClass
    {
        if ($hop > $this->policy->maxHops) {
            throw new ContextProcessingException('loading remote context failed');
        }

        // The policy is enforced against the requested URL and every redirect hop
        // inside this call; $effectiveUrl is the URL the response was ultimately
        // served from, and is the base for resolving relative "Link" headers.
        [$response, $statusCode, $headers, $effectiveUrl] = $this->requestFollowingRedirects($url);

        if (400 <= $statusCode) {
            $response->cancel();

            // Deliberately opaque: the response body of a remote host must never
            // travel back to the caller, who may well be the one who chose the URL.
            throw new ContextProcessingException('loading remote context failed');
        }

        $contentType = $headers['content-type'][0] ?? '';
        $externalContextNode = null;

        if ('application/ld+json' !== $contentType) {
            $parsedLinkHeaders = LinkHeaderParser::parse($headers['link'] ?? []);

            if ($parsedLinkHeaders) {
                // try to see at an alternate location https://www.w3.org/TR/json-ld/#alternate-document-location
                $alternateLocationHeader = LinkHeaderParser::selectAlternateJsonLdLocations($parsedLinkHeaders);

                if (\count($alternateLocationHeader) > 1) {
                    // The spec forbids more than one alternate link header, but the
                    // failure must stay opaque and catchable like every other one.
                    // A response MUST NOT contain more than one HTTP Link Header using the alternate link relation with type="application/ld+json".
                    $response->cancel();

                    throw new ContextProcessingException('loading remote context failed');
                } elseif (1 === \count($alternateLocationHeader)) {
                    $response->cancel();

                    return $this->doLoad(
                        IriResolver::resolveIri($effectiveUrl, $alternateLocationHeader[0]['uri']),
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
                    $externalContextURLs = LinkHeaderParser::selectJsonLdContexts($parsedLinkHeaders);

                    if (\count($externalContextURLs) > 1) {
                        // The spec forbids more than one context link header, but the
                        // failure must stay opaque and catchable like every other one.
                        // A response MUST NOT contain more than one HTTP Link Header using the http://www.w3.org/ns/json-ld#context link relation.
                        $response->cancel();

                        throw new ContextProcessingException('loading remote context failed');
                    } elseif (1 === \count($externalContextURLs)) {
                        // inject this context
                        $externalContextNode = $this->doLoad(
                            IriResolver::resolveIri($effectiveUrl, $externalContextURLs[0]['uri']),
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
     * Issues the request and follows redirects one hop at a time, re-checking the
     * policy against every intermediate Location before it is requested. Symfony's
     * own redirect following is turned off ("max_redirects" => 0) precisely so that
     * a redirect cannot walk out of the allow-list between two policy checks.
     *
     * @return array{ResponseInterface, int, array<string, list<string>>, string}
     */
    private function requestFollowingRedirects(string $url): array
    {
        $redirects = 0;

        while (true) {
            if (!$this->policy->allows($url)) {
                throw new ContextProcessingException('loading remote context failed');
            }

            try {
                $response = $this->httpClient()->request('GET', $url, [
                    'headers' => [
                        'Accept' => 'application/ld+json,application/json,*/*;q=0.1',
                        'User-Agent' => 'Mozilla/5.0 (compatible; redirection-io/1.0; +https://redirection.io/)',
                    ],
                    'timeout' => $this->policy->timeout,
                    'max_duration' => $this->policy->maxDuration,
                    'max_redirects' => 0,
                    'buffer' => false,
                ]);

                $statusCode = $response->getStatusCode();
                $headers = $response->getHeaders(throw: false);
            } catch (ExceptionInterface) {
                throw new ContextProcessingException('loading remote context failed');
            }

            if ($statusCode < 300 || $statusCode >= 400) {
                // Belt and suspenders: even though every hop above was policy
                // checked, re-check the URL the response reports having been served
                // from, in case the injected client followed a redirect of its own.
                $effectiveUrl = $response->getInfo('url');

                if (\is_string($effectiveUrl) && !$this->policy->allows($effectiveUrl)) {
                    $response->cancel();

                    throw new ContextProcessingException('loading remote context failed');
                }

                return [$response, $statusCode, $headers, \is_string($effectiveUrl) ? $effectiveUrl : $url];
            }

            $location = $headers['location'][0] ?? null;
            $response->cancel();

            if (null === $location || ++$redirects > $this->policy->maxRedirects) {
                throw new ContextProcessingException('loading remote context failed');
            }

            $url = IriResolver::resolveIri($url, $location);
        }
    }

    /**
     * Streams the response so that an oversized body is cut off instead of being
     * buffered whole.
     */
    private function readBoundedContent(ResponseInterface $response): string
    {
        $content = '';

        try {
            foreach ($this->httpClient()->stream($response) as $chunk) {
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
}
