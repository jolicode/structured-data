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

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\DocumentLoadingException;
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

    private readonly HtmlScriptExtractor $htmlScriptExtractor;

    public function __construct(
        ?RemoteContextPolicy $policy = null,
        ?HttpClientInterface $httpClient = null,
        ?HtmlScriptExtractor $htmlScriptExtractor = null,
    ) {
        $this->htmlScriptExtractor = $htmlScriptExtractor ?? new HtmlScriptExtractor();
        $this->policy = $policy ?? RemoteContextPolicy::schemaOrgOnly();
        // The client is created lazily: the default policy refuses every host and
        // never reaches a request, so an application that only relies on the
        // bundled schema.org context needs no HTTP client (and no symfony/http-client)
        // at all.
        $this->httpClient = $httpClient;
    }

    public function load(string $url, LoadDocumentOptions $options = new LoadDocumentOptions()): RemoteDocument
    {
        // The fragment never travels: in an HTML document it names the script
        // element to extract.
        [$requestUrl, $fragment] = self::splitFragment($url);

        return $this->doLoad($requestUrl, $fragment, $options, 1);
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

    /**
     * The default LoadDocumentCallback of the JSON-LD specification, within the
     * boundaries of the policy.
     *
     * see https://www.w3.org/TR/json-ld11-api/#loaddocumentcallback
     */
    private function doLoad(string $url, ?string $fragment, LoadDocumentOptions $options, int $hop): RemoteDocument
    {
        if ($hop > $this->policy->maxHops) {
            throw DocumentLoadingException::loadingFailed();
        }

        // The policy is enforced against the requested URL and every redirect hop
        // inside this call; $effectiveUrl is the URL the response was ultimately
        // served from: it is the URL of the document, and the base for resolving
        // relative "Link" headers.
        [$response, $statusCode, $headers, $effectiveUrl] = $this->requestFollowingRedirects($url, $options);

        if (400 <= $statusCode) {
            $response->cancel();

            // Deliberately opaque: the response body of a remote host must never
            // travel back to the caller, who may well be the one who chose the URL.
            throw DocumentLoadingException::loadingFailed();
        }

        [$contentType, $profile] = self::parseContentType($headers['content-type'][0] ?? '');
        $isJson = RemoteDocument::CONTENT_TYPE_JSON === $contentType || str_ends_with($contentType, '+json');
        $isHtml = RemoteDocument::CONTENT_TYPE_HTML === $contentType || RemoteDocument::CONTENT_TYPE_XHTML === $contentType;
        $links = LinkHeaderParser::parse($headers['link'] ?? []);
        $contextUrl = null;

        if (!$isJson) {
            // A document that is not JSON may say where its JSON-LD form is.
            // see https://www.w3.org/TR/json-ld/#alternate-document-location
            $alternateLocations = LinkHeaderParser::selectAlternateJsonLdLocations($links);

            if (\count($alternateLocations) > 1) {
                // A response MUST NOT contain more than one HTTP Link Header using
                // the alternate link relation with type="application/ld+json".
                $response->cancel();

                throw DocumentLoadingException::loadingFailed();
            }

            if (1 === \count($alternateLocations)) {
                $response->cancel();
                [$alternateUrl, $alternateFragment] = self::splitFragment(IriResolver::resolveIri($effectiveUrl, $alternateLocations[0]['uri']));

                return $this->doLoad($alternateUrl, $alternateFragment, $options, $hop + 1);
            }
        } elseif (RemoteDocument::CONTENT_TYPE_JSON_LD !== $contentType) {
            // Plain JSON may be served with the context that makes it JSON-LD.
            // see https://www.w3.org/TR/json-ld/#interpreting-json-as-json-ld
            $contexts = LinkHeaderParser::selectJsonLdContexts($links);

            if (\count($contexts) > 1) {
                $response->cancel();

                throw new DocumentLoadingException(DocumentLoadingException::MULTIPLE_CONTEXT_LINK_HEADERS);
            }

            if (1 === \count($contexts)) {
                $contextUrl = IriResolver::resolveIri($effectiveUrl, $contexts[0]['uri']);
            }
        }

        if (!$isJson && !$isHtml) {
            $response->cancel();

            throw DocumentLoadingException::loadingFailed();
        }

        $content = $this->readBoundedContent($response);

        if ($isHtml) {
            $extracted = $this->htmlScriptExtractor->extract($content, $fragment, $options);

            return new RemoteDocument($extracted['document'], $effectiveUrl, $contentType, null, $profile, $extracted['base']);
        }

        $document = json_decode($content);

        if (!\is_array($document) && !$document instanceof \stdClass) {
            throw DocumentLoadingException::loadingFailed();
        }

        return new RemoteDocument($document, $effectiveUrl, $contentType, $contextUrl, $profile);
    }

    /**
     * A URL without its fragment, and that fragment.
     *
     * @return array{string, string|null}
     */
    private static function splitFragment(string $url): array
    {
        $position = strpos($url, '#');

        return false === $position ? [$url, null] : [substr($url, 0, $position), substr($url, $position + 1)];
    }

    /**
     * The media type of a Content-Type header, without its parameters, and its
     * "profile" parameter.
     *
     * @return array{string, string|null}
     */
    private static function parseContentType(string $header): array
    {
        $parts = explode(';', $header);
        $profile = null;

        foreach (\array_slice($parts, 1) as $parameter) {
            [$name, $value] = explode('=', $parameter, 2) + [1 => ''];

            if ('profile' === strtolower(trim($name))) {
                $profile = trim($value, " \t\"'");
            }
        }

        return [strtolower(trim($parts[0])), $profile];
    }

    /**
     * Issues the request and follows redirects one hop at a time, re-checking the
     * policy against every intermediate Location before it is requested. Symfony's
     * own redirect following is turned off ("max_redirects" => 0) precisely so that
     * a redirect cannot walk out of the allow-list between two policy checks.
     *
     * @return array{ResponseInterface, int, array<string, list<string>>, string}
     */
    private function requestFollowingRedirects(string $url, LoadDocumentOptions $options): array
    {
        $redirects = 0;

        while (true) {
            if (!$this->policy->allows($url)) {
                throw DocumentLoadingException::loadingFailed();
            }

            try {
                $response = $this->httpClient()->request('GET', $url, [
                    'headers' => [
                        'Accept' => self::acceptHeader($options),
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
                throw DocumentLoadingException::loadingFailed();
            }

            if ($statusCode < 300 || $statusCode >= 400) {
                // Belt and suspenders: even though every hop above was policy
                // checked, re-check the URL the response reports having been served
                // from, in case the injected client followed a redirect of its own.
                $effectiveUrl = $response->getInfo('url');

                if (\is_string($effectiveUrl) && !$this->policy->allows($effectiveUrl)) {
                    $response->cancel();

                    throw DocumentLoadingException::loadingFailed();
                }

                return [$response, $statusCode, $headers, \is_string($effectiveUrl) ? $effectiveUrl : $url];
            }

            $location = $headers['location'][0] ?? null;
            $response->cancel();

            if (null === $location || ++$redirects > $this->policy->maxRedirects) {
                throw DocumentLoadingException::loadingFailed();
            }

            $url = IriResolver::resolveIri($url, $location);
        }
    }

    /**
     * JSON-LD first, then JSON, then HTML, whose script elements may hold
     * JSON-LD. A context is never asked as HTML.
     */
    private static function acceptHeader(LoadDocumentOptions $options): string
    {
        $accept = RemoteDocument::CONTENT_TYPE_JSON_LD;

        if (null !== $options->requestProfile) {
            $accept .= \sprintf(';profile="%s"', $options->requestProfile);
        }

        $accept .= ',' . RemoteDocument::CONTENT_TYPE_JSON . ';q=0.9';

        if (LoadDocumentOptions::PROFILE_CONTEXT !== $options->requestProfile) {
            $accept .= ',' . RemoteDocument::CONTENT_TYPE_HTML . ';q=0.8,' . RemoteDocument::CONTENT_TYPE_XHTML . ';q=0.8';
        }

        return $accept . ',*/*;q=0.1';
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

                    throw DocumentLoadingException::loadingFailed();
                }
            }
        } catch (ExceptionInterface) {
            throw DocumentLoadingException::loadingFailed();
        }

        return $content;
    }
}
