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

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\BlankNode;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\Iri;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\Literal;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsParser;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsSerializer;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\Quad;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\RdfDataset;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\RdfVocabulary;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('rdf')]
class NQuadsTest extends TestCase
{
    public function testItReadsEveryKindOfTerm(): void
    {
        $dataset = (new NQuadsParser())->parse(<<<'NQUADS'
            # a comment, then an empty line

            <http://example.com/s> <http://example.com/p> <http://example.com/o> .
            _:b0 <http://example.com/p> "plain" . # trailing comment
            _:b0 <http://example.com/p> "bonjour"@fr-FR <http://example.com/g> .
            <http://example.com/s> <http://example.com/p> "1"^^<http://www.w3.org/2001/XMLSchema#integer> _:g .
            NQUADS);

        $this->assertEquals([
            new Quad(new Iri('http://example.com/s'), new Iri('http://example.com/p'), new Iri('http://example.com/o')),
            new Quad(new BlankNode('_:b0'), new Iri('http://example.com/p'), new Literal('plain')),
            new Quad(new BlankNode('_:b0'), new Iri('http://example.com/p'), new Literal('bonjour', RdfVocabulary::RDF_LANG_STRING, 'fr-FR'), new Iri('http://example.com/g')),
            new Quad(new Iri('http://example.com/s'), new Iri('http://example.com/p'), new Literal('1', RdfVocabulary::XSD_INTEGER), new BlankNode('_:g')),
        ], $dataset->quads());
    }

    public function testItUnescapesLiteralsAndIris(): void
    {
        $dataset = (new NQuadsParser())->parse('<http://example.com/\u00E9> <http://example.com/p> "a\tb\nc \"d\" \\\\ \u00E9 \U0001F600" .');
        $quad = $dataset->quads()[0];

        $this->assertEquals(new Iri('http://example.com/é'), $quad->subject);
        $this->assertEquals(new Literal("a\tb\nc \"d\" \\ é 😀"), $quad->object);
    }

    public function testItReadsABlankNodeEndingTheStatement(): void
    {
        $dataset = (new NQuadsParser())->parse('_:a.b <http://example.com/p> _:c.');

        $this->assertEquals(new BlankNode('_:a.b'), $dataset->quads()[0]->subject);
        $this->assertEquals(new BlankNode('_:c'), $dataset->quads()[0]->object);
    }

    public function testItReadsABlankNodePredicate(): void
    {
        $dataset = (new NQuadsParser())->parse('_:s _:p _:o .');

        $this->assertEquals(new BlankNode('_:p'), $dataset->quads()[0]->predicate);
    }

    #[DataProvider('provideInvalidStatements')]
    public function testItRefusesWhatIsNotAStatement(string $statement): void
    {
        $this->expectException(JsonLdException::class);

        (new NQuadsParser())->parse($statement);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideInvalidStatements(): iterable
    {
        yield 'no final dot' => ['<http://example.com/s> <http://example.com/p> <http://example.com/o>'];
        yield 'literal subject' => ['"s" <http://example.com/p> <http://example.com/o> .'];
        yield 'literal predicate' => ['<http://example.com/s> "p" <http://example.com/o> .'];
        yield 'two terms' => ['<http://example.com/s> <http://example.com/p> .'];
        yield 'unterminated literal' => ['<http://example.com/s> <http://example.com/p> "o .'];
        yield 'unknown escape' => ['<http://example.com/s> <http://example.com/p> "\q" .'];
        yield 'space in an IRI' => ['<http://example.com/ s> <http://example.com/p> "o" .'];
    }

    public function testItWritesCanonicalStatements(): void
    {
        $dataset = new RdfDataset([
            new Quad(new Iri('http://example.com/s'), new Iri('http://example.com/p'), new Literal("line\nbreak \"quoted\" \\ é")),
            new Quad(new BlankNode('_:b0'), new Iri('http://example.com/p'), new Literal('bonjour', RdfVocabulary::RDF_LANG_STRING, 'fr'), new Iri('http://example.com/g')),
            new Quad(new BlankNode('_:b0'), new Iri('http://example.com/p'), new Literal('1.0E0', RdfVocabulary::XSD_DOUBLE)),
        ]);

        $this->assertSame(
            <<<'NQUADS'
                <http://example.com/s> <http://example.com/p> "line\nbreak \"quoted\" \\ é" .
                _:b0 <http://example.com/p> "bonjour"@fr <http://example.com/g> .
                _:b0 <http://example.com/p> "1.0E0"^^<http://www.w3.org/2001/XMLSchema#double> .

                NQUADS,
            NQuadsSerializer::serialize($dataset),
        );
    }

    public function testADatasetIsASet(): void
    {
        $dataset = new RdfDataset();
        $dataset->add(new Quad(new Iri('http://example.com/s'), new Iri('http://example.com/p'), new Literal('o')));
        $dataset->add(new Quad(new Iri('http://example.com/s'), new Iri('http://example.com/p'), new Literal('o')));
        $dataset->add(new Quad(new Iri('http://example.com/s'), new Iri('http://example.com/p'), new Literal('o'), new Iri('http://example.com/g')));

        $this->assertCount(2, $dataset);
        $this->assertCount(2, iterator_to_array($dataset));
    }

    public function testWhatIsWrittenReadsBackTheSame(): void
    {
        $dataset = new RdfDataset([
            new Quad(new BlankNode('_:b0'), new BlankNode('_:b1'), new Literal("tab\t, feed\f, return\r, quote\", backslash\\"), new BlankNode('_:b2')),
        ]);

        $this->assertEquals($dataset->quads(), (new NQuadsParser())->parse(NQuadsSerializer::serialize($dataset))->quads());
    }
}
