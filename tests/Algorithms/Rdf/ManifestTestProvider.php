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

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\Tests\Algorithms\AbstractJsonLdTestCase;

/**
 * Turns a W3C manifest into PHPUnit data sets, one per entry and named after
 * the fragment of its IRI ("#t0001"), which is what the EARL report maps the
 * outcomes back with.
 *
 * The entries written for a JSON-LD 1.0 processor only are left out: they
 * describe a behaviour JSON-LD 1.1 changed.
 */
final class ManifestTestProvider
{
    public const BASE_IRI = 'https://w3c.github.io/json-ld-api/tests/';

    private const OPTIONS = ['base', 'expandContext', 'processingMode', 'produceGeneralizedRdf', 'rdfDirection', 'useNativeTypes', 'useRdfType'];

    /**
     * What a manifest says of a test without it being an option of the
     * processor: the version of the specification it was written for, whether
     * it is normative, and the canonicalization the JSON literals are compared
     * under, which is the only one there is.
     */
    private const IGNORED_OPTIONS = ['specVersion', 'normative', 'useJCS'];

    /**
     * @return iterable<string, array{input: string, expect: string|null, errorCode: string|null, options: ProcessorOptions}>
     */
    public static function provide(string $suite): iterable
    {
        $manifestFile = \sprintf('%s/%s-manifest.jsonld', AbstractJsonLdTestCase::DATA_PATH, $suite);

        if (!is_file($manifestFile)) {
            throw new \RuntimeException(\sprintf('The manifest "%s" does not exist. Did you forget to install the test suite? Please run the following command : `castor qa:phpunit:prepare`', $manifestFile));
        }

        $manifest = json_decode((string) file_get_contents($manifestFile), true);

        if (!\is_array($manifest) || !\is_array($manifest['sequence'] ?? null)) {
            throw new \RuntimeException(\sprintf('The manifest "%s" could not be read.', $manifestFile));
        }

        foreach ($manifest['sequence'] as $entry) {
            if (!\is_array($entry) || !\is_string($entry['@id'] ?? null) || !\is_string($entry['input'] ?? null)) {
                continue;
            }

            $entryOptions = \is_array($entry['option'] ?? null) ? $entry['option'] : [];

            if ('json-ld-1.0' === ($entryOptions['specVersion'] ?? null)) {
                continue;
            }

            $unknownOptions = array_diff(array_keys($entryOptions), self::OPTIONS, self::IGNORED_OPTIONS);

            if ([] !== $unknownOptions) {
                throw new \RuntimeException(\sprintf('The test "%s" sets options this provider does not know: %s.', $entry['@id'], implode(', ', $unknownOptions)));
            }

            $options = new ProcessorOptions(
                base: \is_string($entryOptions['base'] ?? null) ? $entryOptions['base'] : self::BASE_IRI . $entry['input'],
                expandContext: \is_string($entryOptions['expandContext'] ?? null) ? self::BASE_IRI . $entryOptions['expandContext'] : null,
                processingMode: 'json-ld-1.0' === ($entryOptions['processingMode'] ?? null) ? Context::PROCESSING_MODE_10 : Context::PROCESSING_MODE_11,
                produceGeneralizedRdf: true === ($entryOptions['produceGeneralizedRdf'] ?? false),
                rdfDirection: \is_string($entryOptions['rdfDirection'] ?? null) ? $entryOptions['rdfDirection'] : null,
                useNativeTypes: true === ($entryOptions['useNativeTypes'] ?? false),
                useRdfType: true === ($entryOptions['useRdfType'] ?? false),
            );

            yield $entry['@id'] => [
                'input' => self::read($entry['input']),
                'expect' => \is_string($entry['expect'] ?? null) ? self::read($entry['expect']) : null,
                'errorCode' => \is_string($entry['expectErrorCode'] ?? null) ? $entry['expectErrorCode'] : null,
                'options' => $options,
            ];
        }
    }

    /**
     * Where a file of the test suite is, given its path in the manifest. The
     * RDF suites keep the upstream layout; the few files they borrow from the
     * other suites are filed by kind ("expand/er56-in.jsonld" is in
     * "expand/input/").
     */
    public static function fixturePath(string $path): string
    {
        $file = \sprintf('%s/%s', AbstractJsonLdTestCase::DATA_PATH, $path);

        if (is_file($file)) {
            return $file;
        }

        foreach (['-in.jsonld' => 'input', '-out.jsonld' => 'output', '-context.jsonld' => 'context'] as $suffix => $directory) {
            if (str_ends_with($path, $suffix)) {
                return \sprintf('%s/%s/%s/%s', AbstractJsonLdTestCase::DATA_PATH, \dirname($path), $directory, basename($path));
            }
        }

        return $file;
    }

    private static function read(string $path): string
    {
        $content = @file_get_contents(self::fixturePath($path));

        if (false === $content) {
            throw new \RuntimeException(\sprintf('The fixture "%s" could not be read.', $path));
        }

        return $content;
    }
}
