<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Rdf;

/**
 * An RDF dataset: a set of quads, the default graph being the quads without a
 * graph name.
 *
 * @implements \IteratorAggregate<int, Quad>
 */
final class RdfDataset implements \IteratorAggregate, \Countable
{
    /** @var array<string, Quad> */
    private array $quads = [];

    /**
     * @param iterable<Quad> $quads
     */
    public function __construct(iterable $quads = [])
    {
        foreach ($quads as $quad) {
            $this->add($quad);
        }
    }

    /**
     * A dataset is a set: adding a quad it already holds changes nothing.
     */
    public function add(Quad $quad): void
    {
        $this->quads[NQuadsSerializer::quad($quad)] ??= $quad;
    }

    /**
     * @return list<Quad>
     */
    public function quads(): array
    {
        return array_values($this->quads);
    }

    /**
     * @return \ArrayIterator<int, Quad>
     */
    public function getIterator(): \ArrayIterator
    {
        return new \ArrayIterator($this->quads());
    }

    public function count(): int
    {
        return \count($this->quads);
    }
}
