<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Extraction;

/**
 * Represents a non-fatal extraction problem: a structured-data snippet whose format was
 * detected but whose content could not be parsed. The overall extraction still succeeded
 * because at least one other snippet (potentially in a different format) was usable.
 */
readonly class ExtractionWarning
{
    public function __construct(
        /** The format key that failed (e.g. 'jsonld', 'microdata', 'rdfa'). */
        public string $format,
        /** The reason extraction failed for this format, taken from the extractor's exception. */
        public string $message,
    ) {
    }
}
