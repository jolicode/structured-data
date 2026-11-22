<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\JsonLd\Algorithms\Rdf;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;

/**
 * Reads N-Quads into an RDF dataset. Blank nodes are accepted as predicates, so
 * that generalized RDF can be read back.
 *
 * see https://www.w3.org/TR/n-quads/
 */
final class NQuadsParser
{
    private const IRI = '<((?:[^\x00-\x20<>"{}|^`\\\\]|\\\\u[0-9A-Fa-f]{4}|\\\\U[0-9A-Fa-f]{8})*)>';
    private const BLANK_NODE = '(_:(?:[^\s.<"]|\.(?=[^\s.<"]))+)';
    private const LITERAL = '"((?:[^"\\\\\n\r]|\\\\.)*)"(?:\^\^' . self::IRI . '|@([a-zA-Z]+(?:-[a-zA-Z0-9]+)*))?';
    private const STATEMENT = '/^[ \t]*(?:' . self::IRI . '|' . self::BLANK_NODE . ')[ \t]*'
        . '(?:' . self::IRI . '|' . self::BLANK_NODE . ')[ \t]*'
        . '(?:' . self::IRI . '|' . self::BLANK_NODE . '|' . self::LITERAL . ')[ \t]*'
        . '(?:(?:' . self::IRI . '|' . self::BLANK_NODE . ')[ \t]*)?\.[ \t]*(?:#.*)?$/u';

    private const ESCAPES = [
        't' => "\t",
        'b' => "\x08",
        'n' => "\n",
        'r' => "\r",
        'f' => "\f",
        '"' => '"',
        "'" => "'",
        '\\' => '\\',
    ];

    public function parse(string $nQuads): RdfDataset
    {
        $dataset = new RdfDataset();
        $lines = preg_split('/\r\n|\n|\r/', $nQuads);

        foreach (false === $lines ? [] : $lines as $index => $line) {
            if (1 === preg_match('/^[ \t]*(?:#.*)?$/', $line)) {
                continue;
            }

            if (1 !== preg_match(self::STATEMENT, $line, $matches, \PREG_UNMATCHED_AS_NULL)) {
                throw new JsonLdException(\sprintf('The N-Quads statement at line %d could not be parsed.', $index + 1));
            }

            $matches += array_fill(0, 12, null);

            $object = null !== $matches[7]
                ? $this->literal($matches[7], $matches[8], $matches[9])
                : $this->node($matches[5], $matches[6]);

            $dataset->add(new Quad(
                $this->node($matches[1], $matches[2]),
                $this->node($matches[3], $matches[4]),
                $object,
                null === $matches[10] && null === $matches[11] ? null : $this->node($matches[10], $matches[11]),
            ));
        }

        return $dataset;
    }

    private function node(?string $iri, ?string $blankNode): Iri|BlankNode
    {
        if (null !== $blankNode) {
            return new BlankNode($blankNode);
        }

        return new Iri($this->unescape((string) $iri));
    }

    private function literal(string $value, ?string $datatype, ?string $language): Literal
    {
        if (null !== $language) {
            return new Literal($this->unescape($value), RdfVocabulary::RDF_LANG_STRING, $language);
        }

        return new Literal(
            $this->unescape($value),
            null === $datatype ? RdfVocabulary::XSD_STRING : $this->unescape($datatype),
        );
    }

    private function unescape(string $value): string
    {
        if (!str_contains($value, '\\')) {
            return $value;
        }

        return (string) preg_replace_callback(
            '/\\\\(u[0-9A-Fa-f]{4}|U[0-9A-Fa-f]{8}|.)/su',
            static function (array $match): string {
                $escape = $match[1];

                if (\strlen($escape) > 1 && ('u' === $escape[0] || 'U' === $escape[0])) {
                    $codePoint = (int) hexdec(substr($escape, 1));

                    if ($codePoint > 0x10FFFF || ($codePoint >= 0xD800 && $codePoint <= 0xDFFF)) {
                        throw new JsonLdException('An N-Quads escape sequence does not name a character.');
                    }

                    return mb_chr($codePoint, 'UTF-8');
                }

                return self::ESCAPES[$escape] ?? throw new JsonLdException(\sprintf('"\%s" is not an N-Quads escape sequence.', $escape));
            },
            $value,
        );
    }
}
