<?php

namespace Jolicode\JsonLd\Tests\Benchmark;

use Jolicode\JsonLd\ContextProcessing\ContextProcesser;
use Jolicode\JsonLd\Fixtures\FixturesManager;

class ContextProcesserBench extends AbstractJsonLdBench
{
    public function __construct(
        private ContextProcesser $processer = new ContextProcesser(),
    ) {
    }

    /**
     * @Revs(500)
     * @Iterations(5)
     * @RetryThreshold(2.0)
     */
    public function benchSimpleContext()
    {
        $json = $this->loadJson('context02-in.jsonld');

        $this->processer->extractContext(json_decode($json));
    }

    /**
     * @Revs(500)
     * @Iterations(5)
     * @RetryThreshold(2.0)
     */
    public function benchComplexContext()
    {
        $json = $this->loadJson('context01-in.jsonld');

        $this->processer->extractContext(json_decode($json));
    }

    /**
     * @Revs(500)
     * @Iterations(5)
     * @RetryThreshold(2.0)
     */
    public function benchHttpCallContext()
    {
        $json = $this->loadJson('context09-in.jsonld');

        $this->processer->extractContext(json_decode($json));
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_PROCESS_CONTEXT;
    }
}
