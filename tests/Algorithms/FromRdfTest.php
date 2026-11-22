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
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\FromRdfConverter;
use JoliCode\StructuredData\Tests\Algorithms\Manifest\ManifestTestProvider;
use JoliCode\StructuredData\Tests\Algorithms\Rdf\JsonLdComparator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * @see https://w3c.github.io/json-ld-api/tests/fromRdf-manifest.html
 */
#[Group('fromRdf')]
class FromRdfTest extends TestCase
{
    #[DataProvider('provideManifestEntries')]
    public function testFromRdf(string $input, ?string $expect, ?string $errorCode, ProcessorOptions $options): void
    {
        $converter = new FromRdfConverter();

        if (null !== $errorCode) {
            try {
                $converter->fromRdf($input, $options);
            } catch (JsonLdException $exception) {
                $this->assertSame($errorCode, $exception->getMessage());

                return;
            }

            $this->fail(\sprintf('An exception was expected for this test but none were thrown. Expected error message was : %s', $errorCode));
        }

        $actual = $converter->fromRdf($input, $options);

        $this->assertNotNull($expect, 'A positive evaluation test names its expected output.');
        $this->assertTrue(
            JsonLdComparator::areEquivalent(json_decode($expect), json_decode($actual)),
            \sprintf("The documents are not equivalent.\nExpected:\n%s\nActual:\n%s", $expect, $actual),
        );
    }

    /**
     * @return iterable<string, array{input: string, expect: string|null, errorCode: string|null, options: ProcessorOptions}>
     */
    public static function provideManifestEntries(): iterable
    {
        return ManifestTestProvider::provide(Algorithms::FROM_RDF->value);
    }
}
