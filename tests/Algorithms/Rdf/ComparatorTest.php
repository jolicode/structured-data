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

use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsParser;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * The two comparators the W3C RDF suites are judged with: a comparator that
 * says yes too easily would make every one of those tests pass.
 */
#[Group('rdf')]
class ComparatorTest extends TestCase
{
    #[DataProvider('provideDatasets')]
    public function testDatasetIsomorphism(string $first, string $second, bool $isomorphic): void
    {
        $parser = new NQuadsParser();

        $this->assertSame($isomorphic, RdfDatasetIsomorphism::areIsomorphic($parser->parse($first), $parser->parse($second)));
        $this->assertSame($isomorphic, RdfDatasetIsomorphism::areIsomorphic($parser->parse($second), $parser->parse($first)));
    }

    /**
     * @return iterable<string, array{string, string, bool}>
     */
    public static function provideDatasets(): iterable
    {
        yield 'same ground statements in another order' => [
            "<urn:s> <urn:p> \"a\" .\n<urn:s> <urn:p> \"b\" .",
            "<urn:s> <urn:p> \"b\" .\n<urn:s> <urn:p> \"a\" .",
            true,
        ];
        yield 'renamed blank nodes' => [
            "_:a <urn:p> _:b .\n_:b <urn:p> \"leaf\" .",
            "_:x <urn:p> _:y .\n_:y <urn:p> \"leaf\" .",
            true,
        ];
        yield 'a list, relabelled and shuffled' => [
            "<urn:s> <urn:p> _:l1 .\n_:l1 <urn:first> \"a\" .\n_:l1 <urn:rest> _:l2 .\n_:l2 <urn:first> \"b\" .\n_:l2 <urn:rest> <urn:nil> .",
            "_:z <urn:rest> <urn:nil> .\n_:z <urn:first> \"b\" .\n_:y <urn:rest> _:z .\n_:y <urn:first> \"a\" .\n<urn:s> <urn:p> _:y .",
            true,
        ];
        yield 'a cycle of indistinguishable blank nodes' => [
            "_:a <urn:p> _:b .\n_:b <urn:p> _:c .\n_:c <urn:p> _:a .",
            "_:x <urn:p> _:z .\n_:z <urn:p> _:y .\n_:y <urn:p> _:x .",
            true,
        ];
        yield 'language tags compare without case' => [
            '<urn:s> <urn:p> "a"@en-US .',
            '<urn:s> <urn:p> "a"@en-us .',
            true,
        ];
        yield 'a different literal' => [
            '<urn:s> <urn:p> "a" .',
            '<urn:s> <urn:p> "b" .',
            false,
        ];
        yield 'a different datatype' => [
            '<urn:s> <urn:p> "1" .',
            '<urn:s> <urn:p> "1"^^<http://www.w3.org/2001/XMLSchema#integer> .',
            false,
        ];
        yield 'a missing statement' => [
            "<urn:s> <urn:p> \"a\" .\n<urn:s> <urn:p> \"b\" .",
            '<urn:s> <urn:p> "a" .',
            false,
        ];
        yield 'another graph' => [
            '<urn:s> <urn:p> "a" <urn:g> .',
            '<urn:s> <urn:p> "a" .',
            false,
        ];
        yield 'a blank node where an IRI is expected' => [
            '<urn:s> <urn:p> _:b .',
            '<urn:s> <urn:p> <urn:b> .',
            false,
        ];
        yield 'two blank nodes merged into one' => [
            "_:a <urn:p> \"x\" .\n_:b <urn:q> \"y\" .",
            "_:a <urn:p> \"x\" .\n_:a <urn:q> \"y\" .",
            false,
        ];
        yield 'the same shapes wired differently' => [
            "_:a <urn:p> _:b .\n_:b <urn:p> _:a .\n_:c <urn:p> _:c .",
            "_:a <urn:p> _:b .\n_:b <urn:p> _:c .\n_:c <urn:p> _:a .",
            false,
        ];
        yield 'a list in another order' => [
            "<urn:s> <urn:p> _:l1 .\n_:l1 <urn:first> \"a\" .\n_:l1 <urn:rest> _:l2 .\n_:l2 <urn:first> \"b\" .\n_:l2 <urn:rest> <urn:nil> .",
            "<urn:s> <urn:p> _:l1 .\n_:l1 <urn:first> \"b\" .\n_:l1 <urn:rest> _:l2 .\n_:l2 <urn:first> \"a\" .\n_:l2 <urn:rest> <urn:nil> .",
            false,
        ];
    }

    #[DataProvider('provideDocuments')]
    public function testJsonLdEquivalence(string $first, string $second, bool $equivalent): void
    {
        $this->assertSame($equivalent, JsonLdComparator::areEquivalent(json_decode($first), json_decode($second)));
        $this->assertSame($equivalent, JsonLdComparator::areEquivalent(json_decode($second), json_decode($first)));
    }

    /**
     * @return iterable<string, array{string, string, bool}>
     */
    public static function provideDocuments(): iterable
    {
        yield 'keys in another order' => ['[{"@id": "urn:a", "urn:p": [{"@value": 1}]}]', '[{"urn:p": [{"@value": 1}], "@id": "urn:a"}]', true];
        yield 'values in another order' => ['[{"urn:p": [{"@value": 1}, {"@value": 2}]}]', '[{"urn:p": [{"@value": 2}, {"@value": 1}]}]', true];
        yield 'nodes in another order' => ['[{"@id": "urn:a"}, {"@id": "urn:b"}]', '[{"@id": "urn:b"}, {"@id": "urn:a"}]', true];
        yield 'an integer and the same float' => ['[{"@value": 1}]', '[{"@value": 1.0}]', true];
        yield 'a list in the same order' => ['[{"urn:p": [{"@list": [{"@value": 1}, {"@value": 2}]}]}]', '[{"urn:p": [{"@list": [{"@value": 1}, {"@value": 2}]}]}]', true];
        yield 'a list in another order' => ['[{"urn:p": [{"@list": [{"@value": 1}, {"@value": 2}]}]}]', '[{"urn:p": [{"@list": [{"@value": 2}, {"@value": 1}]}]}]', false];
        yield 'a different value' => ['[{"urn:p": [{"@value": 1}]}]', '[{"urn:p": [{"@value": 2}]}]', false];
        yield 'a string and a number' => ['[{"@value": "1"}]', '[{"@value": 1}]', false];
        yield 'a missing entry' => ['[{"@id": "urn:a", "urn:p": []}]', '[{"@id": "urn:a"}]', false];
        yield 'a duplicated value' => ['[{"urn:p": [{"@value": 1}, {"@value": 1}]}]', '[{"urn:p": [{"@value": 1}, {"@value": 2}]}]', false];
        yield 'an object and an array' => ['[{"@value": {}}]', '[{"@value": []}]', false];
        yield 'a missing value' => ['[{"urn:p": [{"@value": 1}, {"@value": 2}]}]', '[{"urn:p": [{"@value": 1}]}]', false];
    }
}
