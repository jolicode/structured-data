<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Manifest;

use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HttpDocumentLoader;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\RemoteContextPolicy;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

/**
 * Stands for https://w3c.github.io/json-ld-api/tests/: it serves the copy of
 * the test suite downloaded at the pinned commit, with the headers a manifest
 * asks for. The tests then run offline, through the real HttpDocumentLoader,
 * against the very revision their manifest comes from.
 */
final class W3cFixtureServer
{
    private const CONTENT_TYPES = [
        'jsonld' => 'application/ld+json',
        'json' => 'application/json',
        'html' => 'text/html',
    ];

    /**
     * @param string|null          $url    the URL the options below apply to: the input of a test
     * @param array<string, mixed> $server how the manifest wants that URL served: "contentType", "httpLink", "redirectTo" and "httpStatus"
     */
    public static function documentLoader(?string $url = null, array $server = []): DocumentLoaderInterface
    {
        $inputUrl = null === $url ? null : explode('#', $url, 2)[0];

        $client = new MockHttpClient(static function (string $method, string $requestedUrl) use ($inputUrl, $server): MockResponse {
            $requestedUrl = (string) preg_replace('/[?#].*$/', '', $requestedUrl);
            $options = $requestedUrl === $inputUrl ? $server : [];

            if (!str_starts_with($requestedUrl, ManifestTestProvider::BASE_IRI) || str_contains($requestedUrl, '..')) {
                return new MockResponse('', ['http_code' => 404]);
            }

            if (\is_string($options['redirectTo'] ?? null)) {
                return new MockResponse('', [
                    'http_code' => \is_int($options['httpStatus'] ?? null) ? $options['httpStatus'] : 302,
                    'response_headers' => ['Location' => ManifestTestProvider::BASE_IRI . $options['redirectTo']],
                ]);
            }

            $file = ManifestTestProvider::fixturePath(substr($requestedUrl, \strlen(ManifestTestProvider::BASE_IRI)));

            if (!is_file($file)) {
                return new MockResponse('', ['http_code' => 404]);
            }

            $headers = [
                'Content-Type' => \is_string($options['contentType'] ?? null)
                    ? $options['contentType']
                    : self::CONTENT_TYPES[pathinfo($file, \PATHINFO_EXTENSION)] ?? 'application/octet-stream',
            ];

            if (isset($options['httpLink'])) {
                $headers['Link'] = array_values(array_filter((array) $options['httpLink'], \is_string(...)));
            }

            return new MockResponse((string) file_get_contents($file), ['response_headers' => $headers]);
        });

        return new HttpDocumentLoader(RemoteContextPolicy::allowHosts('w3c.github.io'), $client);
    }
}
