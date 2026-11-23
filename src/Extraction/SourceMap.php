<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Extraction;

use JoliCode\StructuredData\JsonLd\Parser\Range;

/**
 * Where each key and value of a JSON-LD document built from HTML markup
 * (microdata, RDFa) comes from in that markup.
 *
 * Such a document is generated: the positions the JSON parser computes in it
 * mean nothing to the user. The map records, for each JSON pointer of the
 * generated document, the range of its key and of its value in the HTML
 * source, so that the parsed structure can be anchored on the markup instead.
 *
 * Pointers follow RFC 6901: "" is the root, "/worksFor/name" a nested key,
 * "/image/1" the second value of a repeated property.
 */
final class SourceMap
{
    /**
     * @var array<string, array{key?: Range, value?: Range}>
     */
    private array $entries = [];

    public static function pointerSegment(string|int $segment): string
    {
        return '/' . str_replace(['~', '/'], ['~0', '~1'], (string) $segment);
    }

    public function setKey(string $pointer, ?Range $range): void
    {
        if (null !== $range) {
            $this->entries[$pointer]['key'] = $range;
        }
    }

    public function setValue(string $pointer, ?Range $range): void
    {
        if (null !== $range) {
            $this->entries[$pointer]['value'] = $range;
        }
    }

    public function getKey(string $pointer): ?Range
    {
        return $this->entries[$pointer]['key'] ?? null;
    }

    public function getValue(string $pointer): ?Range
    {
        return $this->entries[$pointer]['value'] ?? null;
    }

    /**
     * Copies the entries of $map under $prefix: a nested item builds its map
     * from its own root, and its parent places it.
     */
    public function merge(self $map, string $prefix): void
    {
        foreach ($map->entries as $pointer => $entry) {
            foreach ($entry as $kind => $range) {
                $this->entries[$prefix . $pointer][$kind] = $range;
            }
        }
    }

    /**
     * Two documents with the same JSON content may come from different places
     * of the page (two identical items, for instance): the fingerprint tells
     * their maps apart.
     */
    public function fingerprint(): string
    {
        $parts = [];

        foreach ($this->entries as $pointer => $entry) {
            foreach ($entry as $kind => $range) {
                $parts[] = $pointer . '|' . $kind . '|' . $range->start . '|' . $range->end;
            }
        }

        return md5(implode("\0", $parts));
    }
}
