<?php

namespace Jolicode\JsonLd\Tests\Benchmark;

use Jolicode\JsonLd\Expand\Expander;
use Jolicode\JsonLd\Fixtures\FixturesManager;
use Jolicode\JsonLd\JsonLd\ProcessorOptions;

class ExpanderBench extends AbstractJsonLdBench
{
    public function __construct(
        private Expander $expander = new Expander(),
        private ProcessorOptions $options = new ProcessorOptions()
    ) {
    }

    /**
     * @Revs(500)
     * @Iterations(5)
     * @RetryThreshold(2.0)
     */
    public function benchSimpleExpansion()
    {
        $this->expandJsonFile('0002-in.jsonld');
    }

    /**
     * @Revs(500)
     * @Iterations(5)
     * @RetryThreshold(2.0)
     */
    public function benchComplexExpansion()
    {
        $this->expandJsonFile('pr25-in.jsonld');
    }

    /**
     * @Revs(500)
     * @Iterations(5)
     * @RetryThreshold(2.0)
     */
    public function benchHttpCallExpansion()
    {
        $this->expandJsonFile('so08-in.jsonld');
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_EXPAND;
    }

    private function expandJsonFile(string $filename): void
    {
        $json = $this->loadJson($filename);
        $this->options->base = $this->getBaseUrlForW3CTests($filename);

        $this->expander->parseJson($json, $this->options);
    }
}
