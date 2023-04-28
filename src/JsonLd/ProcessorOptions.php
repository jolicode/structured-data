<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\JsonLd;

use Jolicode\JsonLd\ContextProcessing\Context;

class ProcessorOptions
{
    public function __construct(
        public ?string $base = null,
        public bool $compactArrays = true,
        public bool $compactToRelative = true,
        public ?string $expandContext = null,
        public bool $extractAllScripts = false,
        public bool $frameExpansion = false,
        public bool $ordered = false,
        public string $processingMode = Context::PROCESSING_MODE_11,
        public bool $produceGeneralizedRdf = true,
        public ?string $rdfDirection = null,
        public bool $useNativeTypes = false,
        public bool $useRdfType = false,
    ) {
    }
}
