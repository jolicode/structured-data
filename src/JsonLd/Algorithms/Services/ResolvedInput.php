<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Services;

/**
 * The input of an algorithm once it is at hand: the document itself, and what
 * loading it from a URL told of it.
 */
final readonly class ResolvedInput
{
    /**
     * @param mixed       $document    the document, as json_decode() gives it without its "assoc" flag
     * @param string|null $base        the base IRI the document is processed with: the "base" option, or else the URL the document was loaded from
     * @param string|null $documentUrl the URL the document was loaded from, redirections followed, when it was given as a URL
     * @param string|null $contextUrl  the context the document was served with, to apply before its own
     */
    public function __construct(
        public mixed $document,
        public ?string $base = null,
        public ?string $documentUrl = null,
        public ?string $contextUrl = null,
    ) {
    }
}
