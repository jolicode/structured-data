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
 * The IRIs the RDF serialization and deserialization algorithms rely on.
 */
final class RdfVocabulary
{
    public const RDF = 'http://www.w3.org/1999/02/22-rdf-syntax-ns#';
    public const RDF_TYPE = self::RDF . 'type';
    public const RDF_FIRST = self::RDF . 'first';
    public const RDF_REST = self::RDF . 'rest';
    public const RDF_NIL = self::RDF . 'nil';
    public const RDF_LIST = self::RDF . 'List';
    public const RDF_JSON = self::RDF . 'JSON';
    public const RDF_LANG_STRING = self::RDF . 'langString';
    public const RDF_VALUE = self::RDF . 'value';
    public const RDF_LANGUAGE = self::RDF . 'language';
    public const RDF_DIRECTION = self::RDF . 'direction';

    public const XSD = 'http://www.w3.org/2001/XMLSchema#';
    public const XSD_STRING = self::XSD . 'string';
    public const XSD_BOOLEAN = self::XSD . 'boolean';
    public const XSD_INTEGER = self::XSD . 'integer';
    public const XSD_DOUBLE = self::XSD . 'double';

    public const I18N = 'https://www.w3.org/ns/i18n#';

    public const RDF_DIRECTION_I18N_DATATYPE = 'i18n-datatype';
    public const RDF_DIRECTION_COMPOUND_LITERAL = 'compound-literal';
}
