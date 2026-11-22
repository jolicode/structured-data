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

/**
 * Writes an RDF dataset as N-Quads.
 *
 * see https://www.w3.org/TR/n-quads/
 */
final class NQuadsSerializer
{
    public static function serialize(RdfDataset $dataset): string
    {
        $lines = [];

        foreach ($dataset->quads() as $quad) {
            $lines[] = self::quad($quad) . "\n";
        }

        return implode('', $lines);
    }

    /**
     * One statement, without its line ending.
     */
    public static function quad(Quad $quad): string
    {
        $terms = [self::term($quad->subject), self::term($quad->predicate), self::term($quad->object)];

        if (null !== $quad->graph) {
            $terms[] = self::term($quad->graph);
        }

        return implode(' ', $terms) . ' .';
    }

    public static function term(Iri|BlankNode|Literal $term): string
    {
        if ($term instanceof Iri) {
            return '<' . $term->value . '>';
        }

        if ($term instanceof BlankNode) {
            return $term->label;
        }

        $literal = '"' . strtr($term->value, ['\\' => '\\\\', '"' => '\"', "\n" => '\n', "\r" => '\r']) . '"';

        if (null !== $term->language) {
            return $literal . '@' . $term->language;
        }

        if (RdfVocabulary::XSD_STRING === $term->datatype) {
            return $literal;
        }

        return $literal . '^^<' . $term->datatype . '>';
    }
}
