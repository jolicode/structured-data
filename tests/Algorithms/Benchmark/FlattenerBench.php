<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Algorithms\Benchmark;

use Jolicode\JsonLd\Algorithms\Fixtures\FixturesInstaller;
use Jolicode\JsonLd\Algorithms\Flatten\Flattener;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;

class FlattenerBench extends AbstractJsonLdBench
{
    public function __construct(
        private readonly Flattener $flattener = new Flattener(),
        private readonly ProcessorOptions $options = new ProcessorOptions()
    ) {
    }

    /**
     * @Revs(500)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleFlattening()
    {
        $this->flattenJsonFile('0002-in.jsonld');
    }

    /**
     * @Revs(500)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexFlattening()
    {
        $this->flattenJsonFile('0036-in.jsonld');
    }

    protected function getAlgorithmName(): string
    {
        return FixturesInstaller::ALGO_FLATTEN;
    }

    private function flattenJsonFile(string $filename): void
    {
        $json = $this->loadJson($filename);
        $this->options->base = $this->getBaseUrlForW3CTests($filename);

        $this->flattener->parseJson($json, $this->options);
    }
}
