<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Rdf;

use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\BlankNode;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\Iri;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\Literal;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\RdfDataset;

/**
 * Tells whether two RDF datasets are the same up to the labels of their blank
 * nodes, which is how the W3C test suite asks a toRdf result to be compared.
 *
 * The blank nodes are first told apart by what surrounds them, then a
 * backtracking search looks for a one to one mapping that turns one dataset
 * into the other.
 *
 * @phpstan-type Term array{bool, string}
 * @phpstan-type Statement array{Term, Term, Term, Term}
 */
final class RdfDatasetIsomorphism
{
    public static function areIsomorphic(RdfDataset $first, RdfDataset $second): bool
    {
        $firstStatements = self::statements($first);
        $secondStatements = self::statements($second);

        if (\count($firstStatements) !== \count($secondStatements)) {
            return false;
        }

        $firstColors = self::colors($firstStatements);
        $secondColors = self::colors($secondStatements);

        $firstClasses = array_count_values($firstColors);
        $secondClasses = array_count_values($secondColors);
        ksort($firstClasses);
        ksort($secondClasses);

        if ($firstClasses !== $secondClasses) {
            return false;
        }

        // The rarest colors first: they leave the fewest candidates to try.
        $blankNodes = array_keys($firstColors);
        usort($blankNodes, static fn (string $a, string $b): int => [$firstClasses[$firstColors[$a]], $a] <=> [$firstClasses[$firstColors[$b]], $b]);

        $target = [];

        foreach ($secondStatements as $statement) {
            $target[self::writtenKey($statement)] = true;
        }

        return self::search($blankNodes, 0, [], [], $firstColors, $secondColors, $firstStatements, $target);
    }

    /**
     * @param list<string>          $blankNodes
     * @param array<string, string> $mapping
     * @param array<string, true>   $used
     * @param array<string, string> $firstColors
     * @param array<string, string> $secondColors
     * @param list<Statement>       $statements
     * @param array<string, true>   $target
     */
    private static function search(array $blankNodes, int $index, array $mapping, array $used, array $firstColors, array $secondColors, array $statements, array $target): bool
    {
        foreach ($statements as $statement) {
            $key = self::key($statement, $mapping);

            if (null !== $key && !\array_key_exists($key, $target)) {
                return false;
            }
        }

        if (!\array_key_exists($index, $blankNodes)) {
            return true;
        }

        $blankNode = $blankNodes[$index];

        foreach ($secondColors as $candidate => $color) {
            if ($color !== $firstColors[$blankNode] || \array_key_exists($candidate, $used)) {
                continue;
            }

            if (self::search($blankNodes, $index + 1, $mapping + [$blankNode => $candidate], $used + [$candidate => true], $firstColors, $secondColors, $statements, $target)) {
                return true;
            }
        }

        return false;
    }

    /**
     * A color per blank node, refined until the blank nodes that can be told
     * apart are: it only depends on the shape of the dataset, never on a label.
     *
     * @param list<Statement> $statements
     *
     * @return array<string, string>
     */
    private static function colors(array $statements): array
    {
        $colors = [];

        foreach ($statements as $statement) {
            foreach ($statement as [$isBlankNode, $value]) {
                if ($isBlankNode) {
                    $colors[$value] = '';
                }
            }
        }

        for ($round = 0; $round <= \count($colors); ++$round) {
            $signatures = array_fill_keys(array_keys($colors), []);

            foreach ($statements as $statement) {
                foreach ($statement as [$isBlankNode, $value]) {
                    if (!$isBlankNode) {
                        continue;
                    }

                    $parts = [];

                    foreach ($statement as [$isOtherBlankNode, $other]) {
                        $parts[] = match (true) {
                            !$isOtherBlankNode => 'G' . $other,
                            $other === $value => 'S',
                            default => 'B' . $colors[$other],
                        };
                    }

                    $signatures[$value][] = implode("\x1F", $parts);
                }
            }

            $refined = [];

            foreach ($signatures as $blankNode => $signature) {
                sort($signature);
                $refined[(string) $blankNode] = hash('xxh128', implode("\x1E", $signature));
            }

            if (\count(array_unique($refined)) === \count(array_unique($colors))) {
                return $refined;
            }

            $colors = $refined;
        }

        return $colors;
    }

    /**
     * The identity of a statement once its blank nodes are renamed, or null
     * when it holds a blank node the mapping does not cover yet.
     *
     * @param Statement             $statement
     * @param array<string, string> $mapping
     */
    private static function key(array $statement, array $mapping): ?string
    {
        $parts = [];

        foreach ($statement as [$isBlankNode, $value]) {
            if (!$isBlankNode) {
                $parts[] = 'G' . $value;

                continue;
            }

            if (!\array_key_exists($value, $mapping)) {
                return null;
            }

            $parts[] = 'B' . $mapping[$value];
        }

        return implode("\x1F", $parts);
    }

    /**
     * The identity of a statement as it is written, blank node labels included.
     *
     * @param Statement $statement
     */
    private static function writtenKey(array $statement): string
    {
        $parts = [];

        foreach ($statement as [$isBlankNode, $value]) {
            $parts[] = ($isBlankNode ? 'B' : 'G') . $value;
        }

        return implode("\x1F", $parts);
    }

    /**
     * @return list<Statement>
     */
    private static function statements(RdfDataset $dataset): array
    {
        $statements = [];

        foreach ($dataset->quads() as $quad) {
            $statements[] = [self::term($quad->subject), self::term($quad->predicate), self::term($quad->object), self::term($quad->graph)];
        }

        return $statements;
    }

    /**
     * @return Term
     */
    private static function term(Iri|BlankNode|Literal|null $term): array
    {
        return match (true) {
            null === $term => [false, ''],
            $term instanceof BlankNode => [true, $term->label],
            $term instanceof Iri => [false, '<' . $term->value . '>'],
            // Language tags are case insensitive.
            default => [false, json_encode([$term->value, $term->datatype, null === $term->language ? null : strtolower($term->language)], \JSON_THROW_ON_ERROR)],
        };
    }
}
