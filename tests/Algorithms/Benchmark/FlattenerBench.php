<?php

namespace Jolicode\JsonLd\Tests\Algorithms\Benchmark;

use Jolicode\JsonLd\Algorithms\Flatten\Flattener;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Algorithms\Fixtures\FixturesManager;
use Jolicode\JsonLd\Tests\Algorithms\Benchmark\AbstractJsonLdBench;

class FlattenerBench extends AbstractJsonLdBench
{
    public function __construct(
        private Flattener $flattener = new Flattener(),
        private ProcessorOptions $options = new ProcessorOptions()
    ) {
    }

    /**
     * @Revs(500)
     * @Iterations(5)
     * @RetryThreshold(2.0)
     */
    public function benchSimpleFlattening()
    {
        $this->flattenJsonFile('0002-in.jsonld');
    }

    /**
     * @Revs(500)
     * @Iterations(5)
     * @RetryThreshold(2.0)
     */
    public function benchComplexFlattening()
    {
        $this->flattenJsonFile('0036-in.jsonld');
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_FLATTEN;
    }

    private function flattenJsonFile(string $filename): void
    {
        $json = $this->loadJson($filename);
        $this->options->base = $this->getBaseUrlForW3CTests($filename);

        $this->flattener->parseJson($json, $this->options);
    }
}
