<?php

namespace Jolicode\JsonLd\JsonLd;

class ProcessorOptions
{
    public function __construct(
        public ?string $base = null,
        public bool $compactArrays = false,
        public bool $compactToRelative = false,
        public ?string $expandContext = null,
        public bool $extractAllScripts = false,
        public bool $frameExpansion = false,
        public bool $ordered = false,
        public string $processingMode = 'json-ld-1.1',
        public bool $produceGeneralizedRdf = true,
        public ?string $rdfDirection = null,
        public bool $useNativeTypes = false,
        public bool $useRdfType = false,
    ) {
    }
}
