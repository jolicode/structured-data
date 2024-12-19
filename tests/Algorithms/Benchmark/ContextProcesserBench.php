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

use Jolicode\JsonLd\Algorithms;
use Jolicode\JsonLd\Algorithms\ContextProcessing\ContextProcesser;

class ContextProcesserBench extends AbstractJsonLdBench
{
    public function __construct(
        private readonly ContextProcesser $processer = new ContextProcesser(),
    ) {
    }

    /**
     * @Revs(500)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchSimpleContext(): void
    {
        $json = $this->loadJson('context02-in.jsonld');

        $this->processer->extractContext(json_decode($json) ?? []);
    }

    /**
     * @Revs(500)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchComplexContext(): void
    {
        $json = $this->loadJson('context01-in.jsonld');

        $this->processer->extractContext(json_decode($json) ?? []);
    }

    /**
     * @Revs(500)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchHttpCallContext(): void
    {
        $json = $this->loadJson('context09-in.jsonld');

        $this->processer->extractContext(json_decode($json) ?? []);
    }

    protected function getAlgorithmName(): string
    {
        return Algorithms::CONTEXT->value;
    }
}
