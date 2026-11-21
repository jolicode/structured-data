<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Rdf;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ContextProcessingException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;

/**
 * Serves the documents the W3C test suite hosts from the copy downloaded at
 * the pinned commit: the tests then run offline, against the very revision
 * their manifest comes from. Anything else is refused.
 */
final class W3cFixtureDocumentLoader implements DocumentLoaderInterface
{
    public function load(string $url): \stdClass
    {
        $path = (string) preg_replace('/[?#].*$/', '', $url);

        if (!str_starts_with($path, ManifestTestProvider::BASE_IRI) || str_contains($path, '..')) {
            throw new ContextProcessingException('loading remote context failed');
        }

        $file = ManifestTestProvider::fixturePath(substr($path, \strlen(ManifestTestProvider::BASE_IRI)));

        if (!is_file($file)) {
            throw new ContextProcessingException('loading remote context failed');
        }

        $document = json_decode((string) file_get_contents($file));

        if (!$document instanceof \stdClass) {
            throw new ContextProcessingException('invalid remote context');
        }

        return $document;
    }

    public function getCacheNamespace(): string
    {
        return 'w3c-fixtures';
    }
}
