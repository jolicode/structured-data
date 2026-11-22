<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\JsonLd;

use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;

class ProcessorOptions
{
    public function __construct(
        public ?string $base = null,
        public bool $compactArrays = true,
        public bool $compactToRelative = true,
        public ?string $expandContext = null,
        /**
         * Documents loaded from a URL that turn out to be HTML: whether every
         * JSON-LD script element is extracted rather than the first one. Null lets
         * the algorithm decide: the first one, except for the deserialization to
         * RDF, which takes them all.
         */
        public ?bool $extractAllScripts = null,
        public bool $frameExpansion = false,
        /**
         * Framing only: whether a single top-level node object is returned without a
         * surrounding @graph entry. Defaults to true in JSON-LD 1.1 processing mode
         * and false in JSON-LD 1.0.
         */
        public ?bool $omitGraph = null,
        public bool $ordered = false,
        public string $processingMode = Context::PROCESSING_MODE_11,
        /**
         * Deserialization to RDF only: whether a triple whose predicate is a blank
         * node is kept. Such a triple is not RDF, so it is dropped by default.
         */
        public bool $produceGeneralizedRdf = false,
        /**
         * RDF algorithms only: how the base direction of a string travels through
         * RDF, which has no room for it. Null drops it, "i18n-datatype" writes it
         * in the datatype, "compound-literal" in a blank node.
         */
        public ?string $rdfDirection = null,
        public bool $useNativeTypes = false,
        public bool $useRdfType = false,
    ) {
    }
}
