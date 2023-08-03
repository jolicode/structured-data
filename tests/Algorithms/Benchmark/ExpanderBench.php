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

use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Fixtures\FixturesInstaller;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;

class ExpanderBench extends AbstractJsonLdBench
{
    public function __construct(
        private readonly Expander $expander = new Expander(),
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
    public function benchSimpleExpansion()
    {
        $this->expandJsonFile('0002-in.jsonld');
    }

    /**
     * @Revs(500)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexExpansion()
    {
        $this->expandJsonFile('pr25-in.jsonld');
    }

    /**
     * @Revs(500)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHttpCallExpansion()
    {
        $this->expandJsonFile('so08-in.jsonld');
    }

    protected function getAlgorithmName(): string
    {
        return FixturesInstaller::ALGO_EXPAND;
    }

    private function expandJsonFile(string $filename): void
    {
        $json = $this->loadJson($filename);
        $this->options->base = $this->getBaseUrlForW3CTests($filename);

        $this->expander->parseJson($json, $this->options);
    }
}
