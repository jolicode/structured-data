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

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\DocumentLoadingException;

/**
 * Resolves the remote documents a JSON-LD document refers to, typically the
 * URLs found in its "@context" entries, and the documents an algorithm is
 * handed as a URL.
 *
 * Implementations decide what may be resolved. Keep in mind that these URLs come
 * from the document being processed, so on untrusted input they are attacker
 * controlled: see docs/remote-contexts.md.
 *
 * see https://www.w3.org/TR/json-ld11-api/#loaddocumentcallback
 */
interface DocumentLoaderInterface
{
    /**
     * @throws DocumentLoadingException with the "loading document failed" message
     *                                  whenever the document cannot be resolved,
     *                                  whatever the reason. The message is the one
     *                                  mandated by the JSON-LD specification, and
     *                                  is deliberately opaque: it must never
     *                                  disclose the response body, the status
     *                                  code, or the URL that was tried. A context
     *                                  that cannot be loaded surfaces as "loading
     *                                  remote context failed", as the
     *                                  specification names it.
     */
    public function load(string $url, LoadDocumentOptions $options = new LoadDocumentOptions()): RemoteDocument;

    /**
     * A stable, deterministic identifier of the loading strategy.
     *
     * Processed contexts are cached for the lifetime of the process. This value
     * partitions that cache, so that a context resolved under a permissive loader
     * can never be served to a restrictive one.
     */
    public function getCacheNamespace(): string;
}
