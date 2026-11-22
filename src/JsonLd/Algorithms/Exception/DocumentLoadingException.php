<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Exception;

/**
 * A remote document could not be loaded. The message is one of the error codes
 * of the JSON-LD specification ("loading document failed", "multiple context
 * link headers", "invalid script element") and nothing else: it never says
 * which URL was tried nor what the remote host answered.
 */
class DocumentLoadingException extends JsonLdException
{
    public const LOADING_DOCUMENT_FAILED = 'loading document failed';
    public const MULTIPLE_CONTEXT_LINK_HEADERS = 'multiple context link headers';
    public const INVALID_SCRIPT_ELEMENT = 'invalid script element';

    public static function loadingFailed(): self
    {
        return new self(self::LOADING_DOCUMENT_FAILED);
    }
}
