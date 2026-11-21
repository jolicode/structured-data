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
 * An RDF literal: a lexical form, a datatype IRI and, for a language-tagged
 * string, a language tag.
 */
final readonly class Literal
{
    public function __construct(
        public string $value,
        public string $datatype = RdfVocabulary::XSD_STRING,
        public ?string $language = null,
    ) {
    }
}
