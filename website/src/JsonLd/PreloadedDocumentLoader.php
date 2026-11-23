<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Website\JsonLd;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\DocumentLoadingException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\LoadDocumentOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\RemoteDocument;

/**
 * Hands out the documents the page fetched: PHP WebAssembly has no network, the
 * browser has. A document that is not there is remembered as missing, for the
 * page to fetch it and run the algorithm again, see bin/playground.php.
 */
final class PreloadedDocumentLoader implements DocumentLoaderInterface
{
    /** @var list<string> */
    private array $loaded = [];

    /** @var list<string> */
    private array $missing = [];

    /** @var list<string> */
    private array $unreadable = [];

    /**
     * @param array<string, string> $documents the body of each document, by URL
     */
    public function __construct(
        private readonly array $documents,
    ) {
    }

    public function load(string $url, LoadDocumentOptions $options = new LoadDocumentOptions()): RemoteDocument
    {
        if (!\array_key_exists($url, $this->documents)) {
            $this->missing[] = $url;

            throw DocumentLoadingException::loadingFailed();
        }

        $document = json_decode($this->documents[$url]);

        if (!$document instanceof \stdClass && !\is_array($document)) {
            $this->unreadable[] = $url;

            throw DocumentLoadingException::loadingFailed();
        }

        $this->loaded[] = $url;

        return new RemoteDocument($document, $url);
    }

    public function getCacheNamespace(): string
    {
        return 'preloaded-' . hash('xxh128', serialize($this->documents));
    }

    /**
     * The documents that were handed out.
     *
     * @return list<string>
     */
    public function getLoaded(): array
    {
        return array_values(array_unique($this->loaded));
    }

    /**
     * The documents that were asked for, and that the page did not give.
     *
     * @return list<string>
     */
    public function getMissing(): array
    {
        return array_values(array_unique($this->missing));
    }

    /**
     * The documents that the page gave, and that are not JSON.
     *
     * @return list<string>
     */
    public function getUnreadable(): array
    {
        return array_values(array_unique($this->unreadable));
    }
}
