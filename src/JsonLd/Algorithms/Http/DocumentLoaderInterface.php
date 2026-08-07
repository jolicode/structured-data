<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\Http;

use Jolicode\JsonLd\Algorithms\Exception\ContextProcessingException;

/**
 * Resolves the remote documents referenced by a JSON-LD document, typically the
 * URLs found in its "@context" entries.
 *
 * Implementations decide what may be resolved. Keep in mind that these URLs come
 * from the document being processed, so on untrusted input they are attacker
 * controlled: see the "Loading remote contexts" section of the README.
 */
interface DocumentLoaderInterface
{
    /**
     * @throws ContextProcessingException with the "loading remote context failed"
     *                                    message whenever the document cannot be
     *                                    resolved, whatever the reason. The message
     *                                    is the one mandated by the JSON-LD
     *                                    specification, and is deliberately opaque:
     *                                    it must never disclose the response body,
     *                                    the status code, or the URL that was tried
     */
    public function load(string $url): \stdClass;

    /**
     * A stable, deterministic identifier of the loading strategy.
     *
     * Processed contexts are cached for the lifetime of the process. This value
     * partitions that cache, so that a context resolved under a permissive loader
     * can never be served to a restrictive one.
     */
    public function getCacheNamespace(): string;
}
