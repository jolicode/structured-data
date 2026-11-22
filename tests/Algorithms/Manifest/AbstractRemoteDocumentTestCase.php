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

use JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\Flatten\Flattener;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsParser;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsSerializer;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\ToRdfConverter;
use JoliCode\StructuredData\Tests\Algorithms\Rdf\RdfDatasetIsomorphism;
use PHPUnit\Framework\TestCase;

/**
 * Runs the entries of a W3C manifest whose input is the URL of a document:
 * the algorithm the entry names is handed that URL, and W3cFixtureServer
 * answers it the way the manifest says.
 */
abstract class AbstractRemoteDocumentTestCase extends TestCase
{
    /**
     * @param array<string, mixed> $server
     */
    protected function runManifestEntry(string $algorithm, string $url, ?string $context, ?string $expect, ?string $errorCode, ProcessorOptions $options, array $server): void
    {
        if (null !== $errorCode) {
            try {
                $this->process($algorithm, $url, $context, $options, $server);
            } catch (JsonLdException $exception) {
                $this->assertSame($errorCode, $exception->getMessage());

                return;
            }

            $this->fail(\sprintf('An exception was expected for this test but none were thrown. Expected error message was : %s', $errorCode));
        }

        $actual = $this->process($algorithm, $url, $context, $options, $server);

        $this->assertNotNull($expect, 'A positive evaluation test names its expected output.');

        if ('toRdf' === $algorithm) {
            $this->assertTrue(
                RdfDatasetIsomorphism::areIsomorphic((new NQuadsParser())->parse($expect), (new NQuadsParser())->parse($actual)),
                \sprintf("The datasets are not isomorphic.\nExpected:\n%s\nActual:\n%s", $expect, $actual),
            );

            return;
        }

        $this->assertEquals(json_decode($expect), json_decode($actual), \sprintf("Expected:\n%s\nActual:\n%s", $expect, $actual));
    }

    /**
     * @param array<string, mixed> $server
     */
    private function process(string $algorithm, string $url, ?string $context, ProcessorOptions $options, array $server): string
    {
        $documentLoader = W3cFixtureServer::documentLoader($url, $server);

        $result = match ($algorithm) {
            'expand' => (new Expander(documentLoader: $documentLoader))->expand($url, $options),
            'compact' => (new Compactor(documentLoader: $documentLoader))->compact($url, $context, $options),
            'flatten' => (new Flattener(documentLoader: $documentLoader))->flatten($url, $context, $options),
            'toRdf' => NQuadsSerializer::serialize((new ToRdfConverter(documentLoader: $documentLoader))->toRdf($url, $options)),
            default => throw new \LogicException(\sprintf('The "%s" algorithm does not take a URL.', $algorithm)),
        };

        $this->assertIsString($result);

        return $result;
    }
}
