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
 * RDF only holds well-formed IRIs and language tags: a triple that would carry
 * anything else is left out of the dataset, without an error.
 */
final class WellFormedness
{
    public static function isIri(mixed $value): bool
    {
        return \is_string($value)
            && 1 === preg_match('/^[A-Za-z][A-Za-z0-9+.\-]*:[^\x00-\x20<>"{}|\\\\^`#]*(#[^\x00-\x20<>"{}|\\\\^`#]*)?$/', $value);
    }

    public static function isBlankNode(mixed $value): bool
    {
        return \is_string($value) && str_starts_with($value, '_:') && 1 !== preg_match('/\s/', $value);
    }

    /**
     * A language tag as BCP 47 shapes it.
     */
    public static function isLanguageTag(mixed $value): bool
    {
        return \is_string($value) && 1 === preg_match('/^[a-zA-Z]{1,8}(-[a-zA-Z0-9]{1,8})*$/', $value);
    }
}
