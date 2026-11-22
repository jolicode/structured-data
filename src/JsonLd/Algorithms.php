<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd;

enum Algorithms: string
{
    case CONTEXT = 'context';
    case FLATTEN = 'flatten';
    case COMPACT = 'compact';
    case EXPAND = 'expand';
    case FRAME = 'frame';
    case TO_RDF = 'toRdf';
    case FROM_RDF = 'fromRdf';

    public const HTML_SUITE = 'html';
    public const REMOTE_DOC_SUITE = 'remote-doc';

    /**
     * The list of algorithms that are part of the official test suite.
     * Other algorithms are handled in a different way.
     * see https://github.com/w3c/json-ld-api/tree/main/tests.
     *
     * @return array<string>
     */
    public static function algorithmNames(): array
    {
        return [
            self::FLATTEN->value,
            self::COMPACT->value,
            self::EXPAND->value,
        ];
    }

    /**
     * The suites of the official test suite whose tests are driven by their
     * manifest: their fixtures keep the upstream layout. "html" and
     * "remote-doc" are not algorithms, they exercise the others on documents
     * loaded from a URL.
     *
     * @return list<string>
     */
    public static function manifestDrivenSuiteNames(): array
    {
        return [
            self::TO_RDF->value,
            self::FROM_RDF->value,
            self::HTML_SUITE,
            self::REMOTE_DOC_SUITE,
        ];
    }
}
