<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Http;

/**
 * What a document loader hands back: the document, and what the algorithms
 * need to know of where it came from.
 *
 * see https://www.w3.org/TR/json-ld11-api/#remotedocument
 */
final readonly class RemoteDocument
{
    public const CONTENT_TYPE_JSON_LD = 'application/ld+json';
    public const CONTENT_TYPE_JSON = 'application/json';
    public const CONTENT_TYPE_HTML = 'text/html';
    public const CONTENT_TYPE_XHTML = 'application/xhtml+xml';

    /**
     * @param \stdClass|array<mixed> $document    the parsed document, as json_decode() gives it without its "assoc" flag
     * @param string                 $documentUrl the final URL of the document, redirections followed
     * @param string                 $contentType the content type of the document, without its parameters
     * @param string|null            $contextUrl  the context a JSON document that is not JSON-LD was served with, through an HTTP Link header
     * @param string|null            $profile     the "profile" parameter of the content type
     * @param string|null            $htmlBase    the "href" of the base element of an HTML document, as written: it takes precedence over the "base" option, and is resolved against it when relative
     */
    public function __construct(
        public \stdClass|array $document,
        public string $documentUrl,
        public string $contentType = self::CONTENT_TYPE_JSON_LD,
        public ?string $contextUrl = null,
        public ?string $profile = null,
        public ?string $htmlBase = null,
    ) {
    }
}
