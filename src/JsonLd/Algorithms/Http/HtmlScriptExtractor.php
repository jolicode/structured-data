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
 * Extracts the JSON-LD an HTML document embeds in its script elements, as a
 * document loader supporting HTML script extraction does.
 *
 * This is a PHP implementation of the Process HTML and Extract Script Content
 * algorithms of the JSON-LD 1.1 Processing Algorithms and API W3C
 * Recommendation published on July 16th, 2020.
 *
 * see https://www.w3.org/TR/json-ld11-api/#html-content-algorithms
 */
final class HtmlScriptExtractor
{
    /**
     * @param string|null $fragment the fragment identifier of the URL the document was asked with, which targets one script element by its "id"
     *
     * @return array{document: \stdClass|array<mixed>, base: string|null} the extracted document, and the "href" of the base element, if any
     */
    public function extract(string $html, ?string $fragment = null, LoadDocumentOptions $options = new LoadDocumentOptions()): array
    {
        try {
            $dom = \Dom\HTMLDocument::createFromString($html, \LIBXML_NOERROR, 'UTF-8');
        } catch (\Throwable) {
            throw DocumentLoadingException::loadingFailed();
        }

        $base = $dom->querySelector('base[href]')?->getAttribute('href');
        $source = null;

        if (null !== $fragment && '' !== $fragment) {
            // 1.2
            $element = $dom->getElementById(rawurldecode($fragment));

            if (null === $element || !self::isJsonLdScript($element)) {
                throw DocumentLoadingException::loadingFailed();
            }

            $source = $element->textContent;
        } elseif (null !== $options->profile) {
            // 1.3
            foreach (self::jsonLdScripts($dom) as $script) {
                if (self::typeParameter($script, 'profile') === $options->profile) {
                    $source = $script->textContent;

                    break;
                }
            }
        }

        // 1.4
        if (null === $source && !$options->extractAllScripts) {
            $source = self::jsonLdScripts($dom)[0]->textContent ?? throw DocumentLoadingException::loadingFailed();
        }

        // 1.5
        if (null !== $source) {
            return ['document' => self::extractScriptContent($source), 'base' => $base];
        }

        // 1.6
        $document = [];

        foreach (self::jsonLdScripts($dom) as $script) {
            $content = self::extractScriptContent($script->textContent ?? '');

            if (\is_array($content)) {
                array_push($document, ...array_values($content));
            } else {
                $document[] = $content;
            }
        }

        return ['document' => $document, 'base' => $base];
    }

    /**
     * The Extract Script Content algorithm: the text of a script element is
     * JSON, as it is written. A comment around it makes it something else.
     *
     * @return \stdClass|array<mixed>
     */
    private static function extractScriptContent(string $source): \stdClass|array
    {
        $content = json_decode($source);

        if (!$content instanceof \stdClass && !\is_array($content)) {
            throw new DocumentLoadingException(DocumentLoadingException::INVALID_SCRIPT_ELEMENT);
        }

        return $content;
    }

    /**
     * @return list<\Dom\Element>
     */
    private static function jsonLdScripts(\Dom\HTMLDocument $dom): array
    {
        $scripts = [];

        foreach ($dom->getElementsByTagName('script') as $script) {
            if (self::isJsonLdScript($script)) {
                $scripts[] = $script;
            }
        }

        return $scripts;
    }

    private static function isJsonLdScript(\Dom\Element $element): bool
    {
        if ('script' !== strtolower($element->localName)) {
            return false;
        }

        $type = strtolower(trim(explode(';', $element->getAttribute('type') ?? '', 2)[0]));

        return RemoteDocument::CONTENT_TYPE_JSON_LD === $type;
    }

    /**
     * A parameter of the "type" attribute of a script element, such as the
     * profile in "application/ld+json;profile=http://www.w3.org/ns/json-ld#context".
     */
    private static function typeParameter(\Dom\Element $element, string $name): ?string
    {
        foreach (\array_slice(explode(';', $element->getAttribute('type') ?? ''), 1) as $parameter) {
            [$key, $value] = explode('=', $parameter, 2) + [1 => ''];

            if (strtolower(trim($key)) === $name) {
                return trim($value, " \t\"'");
            }
        }

        return null;
    }
}
