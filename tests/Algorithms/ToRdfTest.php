<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms;

use JoliCode\StructuredData\JsonLd\Algorithms;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsParser;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsSerializer;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\ToRdfConverter;
use JoliCode\StructuredData\Tests\Algorithms\Rdf\ManifestTestProvider;
use JoliCode\StructuredData\Tests\Algorithms\Rdf\RdfDatasetIsomorphism;
use JoliCode\StructuredData\Tests\Algorithms\Rdf\W3cFixtureDocumentLoader;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * @see https://w3c.github.io/json-ld-api/tests/toRdf-manifest.html
 */
#[Group('toRdf')]
class ToRdfTest extends TestCase
{
    #[DataProvider('provideManifestEntries')]
    public function testToRdf(string $input, ?string $expect, ?string $errorCode, ProcessorOptions $options): void
    {
        $converter = new ToRdfConverter(documentLoader: new W3cFixtureDocumentLoader());

        if (null !== $errorCode) {
            try {
                $converter->toRdf($input, $options);
            } catch (JsonLdException $exception) {
                $this->assertSame($errorCode, $exception->getMessage());

                return;
            }

            $this->fail(\sprintf('An exception was expected for this test but none were thrown. Expected error message was : %s', $errorCode));
        }

        $dataset = $converter->toRdf($input, $options);
        $parser = new NQuadsParser();
        $serialized = NQuadsSerializer::serialize($dataset);

        // What is written must read back as the same dataset, and this is all a
        // syntax test asks for.
        $this->assertTrue(RdfDatasetIsomorphism::areIsomorphic($dataset, $parser->parse($serialized)), 'The dataset does not survive its own serialization.');

        if (null !== $expect) {
            $this->assertTrue(
                RdfDatasetIsomorphism::areIsomorphic($parser->parse($expect), $dataset),
                \sprintf("The datasets are not isomorphic.\nExpected:\n%s\nActual:\n%s", $expect, $serialized),
            );
        }
    }

    /**
     * @return iterable<string, array{input: string, expect: string|null, errorCode: string|null, options: ProcessorOptions}>
     */
    public static function provideManifestEntries(): iterable
    {
        return ManifestTestProvider::provide(Algorithms::TO_RDF->value);
    }
}
