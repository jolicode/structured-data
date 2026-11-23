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
        /**
         * For a document generated from HTML markup (microdata, RDFa), where its
         * keys and values come from in that markup. The positions computed in
         * the generated JSON are replaced by these ones once it is parsed.
         */
        public ?SourceMap $sourceMap = null,
    ) {
    }
}
