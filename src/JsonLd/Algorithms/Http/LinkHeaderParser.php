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

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ContextProcessingException;

/**
 * Parses HTTP Link headers and picks out the relations JSON-LD cares about.
 */
final class LinkHeaderParser
{
    /**
     * @param array<string> $headers
     *
     * @return array<array<string, string>>
     */
    public static function parse(array $headers): array
    {
        $parsed = [];

        foreach ($headers as $key => $header) {
            if (str_contains($header, ',')) {
                $parts = preg_split('/,(?=\s*<.*>([^"]*"[^"]*")*[^"]*$)/', $header);

                if (false === $parts) {
                    throw new ContextProcessingException('loading remote context failed');
                }

                foreach ($parts as $part) {
                    $headers[] = trim($part);
                }

                unset($headers[$key]);
            }
        }

        foreach ($headers as $header) {
            if (preg_match('/^<([^>]*)>(?:\s?;\s?(.+))?$/', trim($header), $matches)) {
                $item = [
                    'uri' => $matches[1],
                ];

                if (isset($matches[2])) {
                    $parameters = preg_split('/;(?=([^"]*"[^"]*")*[^"]*$)/', $matches[2]);

                    if (false === $parameters) {
                        throw new ContextProcessingException('loading remote context failed');
                    }

                    foreach ($parameters as $parameter) {
                        $keyValue = preg_split('/=(?=([^"]*"[^"]*")*$)/', $parameter);

                        // Skip valueless parameters (e.g. a bare "rel"); the trim
                        // char-list strips only surrounding whitespace and quotes.
                        if (false === $keyValue || !isset($keyValue[1])) {
                            continue;
                        }

                        $item[trim($keyValue[0])] = trim($keyValue[1], " \t\"'");
                    }
                }

                $parsed[] = $item;
            }
        }

        return $parsed;
    }

    /**
     * Alternate JSON-LD document locations.
     *
     * see https://www.w3.org/TR/json-ld/#alternate-document-location
     *
     * @param array<array<string, string>> $links
     *
     * @return array<array<string, string>>
     */
    public static function selectAlternateJsonLdLocations(array $links): array
    {
        return array_values(array_filter($links, static function ($link) {
            return isset($link['rel'])
                && isset($link['type'])
                && \in_array('alternate', explode(' ', $link['rel']), true)
                && 'application/ld+json' === $link['type'];
        }));
    }

    /**
     * Contexts advertised through a rel="http://www.w3.org/ns/json-ld#context" link.
     *
     * see https://www.w3.org/TR/json-ld/#interpreting-json-as-json-ld
     *
     * @param array<array<string, string>> $links
     *
     * @return array<array<string, string>>
     */
    public static function selectJsonLdContexts(array $links): array
    {
        return array_values(array_filter($links, static function ($link) {
            return isset($link['rel'])
                && \in_array('http://www.w3.org/ns/json-ld#context', explode(' ', $link['rel']), true);
        }));
    }
}
