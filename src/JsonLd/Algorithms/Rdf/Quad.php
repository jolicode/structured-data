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
 * An RDF quad. A null graph stands for the default graph. A blank node may be
 * a predicate: this is generalized RDF, see the "produceGeneralizedRdf" option.
 */
final readonly class Quad
{
    public function __construct(
        public Iri|BlankNode $subject,
        public Iri|BlankNode $predicate,
        public Iri|BlankNode|Literal $object,
        public Iri|BlankNode|null $graph = null,
    ) {
    }
}
