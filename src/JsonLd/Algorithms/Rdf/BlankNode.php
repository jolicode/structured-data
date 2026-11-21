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
 * A blank node, as a term of an RDF quad. The label keeps its "_:" prefix.
 */
final readonly class BlankNode
{
    public function __construct(
        public string $label,
    ) {
    }
}
