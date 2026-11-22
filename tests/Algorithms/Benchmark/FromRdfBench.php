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
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\FromRdfConverter;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsParser;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\RdfDataset;

class FromRdfBench extends AbstractJsonLdBench
{
    public const LARGE_DATASET_NODES = 200;

    private readonly string $largeNQuads;
    private readonly RdfDataset $largeDataset;

    public function __construct(
        private readonly FromRdfConverter $converter = new FromRdfConverter(),
    ) {
        $this->largeNQuads = self::buildLargeNQuads();
        $this->largeDataset = (new NQuadsParser())->parse($this->largeNQuads);
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchMinimalDatasetSerialization(): void
    {
        $this->serializeNQuadsFile('0002-in.nq');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchListSerialization(): void
    {
        $this->serializeNQuadsFile('li03-in.nq');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchNativeTypesSerialization(): void
    {
        $this->serializeNQuadsFile('0027-in.nq', new ProcessorOptions(useNativeTypes: true));
    }

    /**
     * 200 nodes of 8 statements each, a two-item list among them, read from
     * N-Quads: the parsing is part of the measure.
     *
     * @Revs(10)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchLargeNQuadsSerialization(): void
    {
        $this->converter->fromRdf($this->largeNQuads);
    }

    /**
     * The same dataset, already parsed: the algorithm alone.
     *
     * @Revs(10)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchLargeDatasetSerialization(): void
    {
        $this->converter->fromRdf($this->largeDataset);
    }

    protected function getAlgorithmName(): string
    {
        return Algorithms::FROM_RDF->value;
    }

    private function serializeNQuadsFile(string $filename, ProcessorOptions $options = new ProcessorOptions()): void
    {
        $this->converter->fromRdf($this->loadFixture(\sprintf('%s/%s', $this->getAlgorithmName(), $filename)), $options);
    }

    private static function buildLargeNQuads(): string
    {
        $rdf = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
        $lines = [];

        for ($i = 0; $i < self::LARGE_DATASET_NODES; ++$i) {
            $subject = \sprintf('<https://example.com/person/%d>', $i);
            $lines[] = \sprintf('%s <%stype> <http://schema.org/Person> .', $subject, $rdf);
            $lines[] = \sprintf('%s <http://schema.org/name> "person %d"@en .', $subject, $i);
            $lines[] = \sprintf('%s <http://schema.org/height> "1.75E0"^^<http://www.w3.org/2001/XMLSchema#double> .', $subject);
            $lines[] = \sprintf('%s <http://schema.org/knows> _:l%da .', $subject, $i);
            $lines[] = \sprintf('_:l%da <%sfirst> <https://example.com/person/0> .', $i, $rdf);
            $lines[] = \sprintf('_:l%da <%srest> _:l%db .', $i, $rdf, $i);
            $lines[] = \sprintf('_:l%db <%sfirst> "a friend" .', $i, $rdf);
            $lines[] = \sprintf('_:l%db <%srest> <%snil> .', $i, $rdf, $rdf);
        }

        return implode("\n", $lines) . "\n";
    }
}
