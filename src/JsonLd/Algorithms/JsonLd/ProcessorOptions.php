<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\JsonLd;

use Jolicode\JsonLd\Algorithms\ContextProcessing\Context;

class ProcessorOptions
{
    public function __construct(
        public ?string $base = null,
        public bool $compactArrays = true,
        public bool $compactToRelative = true,
        public ?string $expandContext = null,
        public bool $extractAllScripts = false,
        public bool $frameExpansion = false,
        /**
         * Framing only: whether a single top-level node object is returned without a
         * surrounding @graph entry. Defaults to true in JSON-LD 1.1 processing mode
         * and false in JSON-LD 1.0.
         */
        public ?bool $omitGraph = null,
        public bool $ordered = false,
        public string $processingMode = Context::PROCESSING_MODE_11,
        public bool $produceGeneralizedRdf = true,
        public ?string $rdfDirection = null,
        public bool $useNativeTypes = false,
        public bool $useRdfType = false,
    ) {
    }
}
