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
use JoliCode\StructuredData\JsonLd\Algorithms\Frame\Framer;

class FramerBench extends AbstractJsonLdBench
{
    private const LIBRARY = '{"@context":"https://schema.org","@graph":[{"@id":"#lib","@type":"Library","name":"City Library","containedInPlace":{"@id":"#place"}},{"@id":"#place","@type":"Place","name":"Downtown"}]}';

    public function __construct(
        private readonly Framer $framer = new Framer(),
    ) {
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchTypeFraming(): void
    {
        $this->framer->frame(self::LIBRARY, '{"@context":"https://schema.org","@type":"Library"}');
    }

    /**
     * @Revs(50)
     *
     * @Iterations(5)
     *
     * @RetryThreshold(2.0)
     */
    public function benchEmbeddedNodeFraming(): void
    {
        $this->framer->frame(self::LIBRARY, '{"@context":"https://schema.org","containedInPlace":{}}');
    }

    protected function getAlgorithmName(): string
    {
        return Algorithms::FRAME->value;
    }
}
