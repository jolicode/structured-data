<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Extraction;

class JsonLdElement
{
    public function __construct(
        public int $startLine,
        public int $startColumn,
        public string $content,
        public ExtractorFormat $sourceFormat,
    ) {
    }
}
