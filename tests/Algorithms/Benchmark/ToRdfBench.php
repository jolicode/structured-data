<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Benchmark;

use JoliCode\StructuredData\JsonLd\Algorithms;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsSerializer;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\ToRdfConverter;

class ToRdfBench extends AbstractJsonLdBench
{
    public function __construct(
        private readonly ToRdfConverter $converter = new ToRdfConverter(),
    ) {
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchMinimalDocumentDeserialization(): void
    {
        $this->deserializeJsonFile('0002-in.jsonld');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchListDeserialization(): void
    {
        $this->deserializeJsonFile('0036-in.jsonld');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchNestedGraphDeserialization(): void
    {
        $this->deserializeJsonFile('pr25-in.jsonld');
    }

    /**
     * A JSON literal is written in its canonical form (RFC 8785), numbers
     * included: this is the one value the deserialization has to compute.
     *
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchJsonLiteralDeserialization(): void
    {
        $this->deserializeJsonFile('js12-in.jsonld');
    }

    /**
     * The whole way from a schema.org document to N-Quads: expansion with the
     * schema.org context, node map, dataset, then serialization.
     *
     * @Revs(20)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSchemaOrgDocumentToNQuads(): string
    {
        $nodes = [];

        for ($i = 0; $i < 8; ++$i) {
            $nodes[] = \sprintf('{"@id": "https://example.com/person/%1$d", "@type": "Person", "name": "person %1$d", "knows": {"@id": "https://example.com/person/0"}, "height": 1.75, "birthDate": "1990-01-01"}', $i);
        }

        return NQuadsSerializer::serialize($this->converter->toRdf(\sprintf('{"@context": "https://schema.org", "@graph": [%s]}', implode(',', $nodes))));
    }

    protected function getAlgorithmName(): string
    {
        return Algorithms::TO_RDF->value;
    }

    private function deserializeJsonFile(string $filename): void
    {
        $this->converter->toRdf(
            $this->loadFixture(\sprintf('%s/%s', $this->getAlgorithmName(), $filename)),
            new ProcessorOptions(base: $this->getBaseUrlForW3CTests($filename)),
        );
    }
}
