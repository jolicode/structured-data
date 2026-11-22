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
 * What an algorithm asks of a document loader.
 *
 * see https://www.w3.org/TR/json-ld11-api/#loaddocumentoptions
 */
final readonly class LoadDocumentOptions
{
    /**
     * The profile a context is asked with.
     */
    public const PROFILE_CONTEXT = 'http://www.w3.org/ns/json-ld#context';

    /**
     * @param bool        $extractAllScripts whether every JSON-LD script element of an HTML document is extracted, rather than the first one
     * @param string|null $profile           the profile the JSON-LD script element of an HTML document is preferably selected with
     * @param string|null $requestProfile    the profile to ask the document with
     */
    public function __construct(
        public bool $extractAllScripts = false,
        public ?string $profile = null,
        public ?string $requestProfile = null,
    ) {
    }

    public static function forContext(): self
    {
        return new self(profile: self::PROFILE_CONTEXT, requestProfile: self::PROFILE_CONTEXT);
    }
}
