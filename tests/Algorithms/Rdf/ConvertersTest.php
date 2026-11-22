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
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\FromRdfConverter;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\NQuadsSerializer;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\RdfVocabulary;
use JoliCode\StructuredData\JsonLd\Algorithms\Rdf\ToRdfConverter;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * What the W3C suites do not ask of the two converters.
 */
#[Group('rdf')]
class ConvertersTest extends TestCase
{
    private const DOCUMENT = <<<'JSON'
        {
            "@context": {"@vocab": "http://example.com/", "knows": {"@container": "@list"}},
            "@id": "http://example.com/alice",
            "@type": "Person",
            "name": {"@value": "Alice", "@language": "fr"},
            "age": 42,
            "height": 1.72,
            "member": true,
            "data": {"@type": "@json", "@value": {"b": [], "a": {}}},
            "knows": [{"@id": "http://example.com/bob"}, {"name": "Carole"}]
        }
        JSON;

    public function testADocumentSurvivesTheRoundTrip(): void
    {
        $toRdf = new ToRdfConverter();
        $dataset = $toRdf->toRdf(self::DOCUMENT);

        $this->assertCount(12, $dataset);

        $document = (new FromRdfConverter())->fromRdf($dataset, new ProcessorOptions(useNativeTypes: true));

        $this->assertStringContainsString('"@value": 1.72', $document);
        $this->assertTrue(RdfDatasetIsomorphism::areIsomorphic($dataset, $toRdf->toRdf($document)));
    }

    public function testTheCallersDocumentAndOptionsAreLeftAlone(): void
    {
        $document = json_decode(self::DOCUMENT);
        $this->assertInstanceOf(\stdClass::class, $document);
        $options = new ProcessorOptions(ordered: true);

        (new ToRdfConverter())->toRdf($document, $options);

        $this->assertEquals(json_decode(self::DOCUMENT), $document);
        $this->assertTrue($options->ordered);
    }

    public function testABlankNodePredicateIsDroppedUnlessAskedFor(): void
    {
        $document = '{"@id": "http://example.com/s", "_:p": "o"}';
        $converter = new ToRdfConverter();

        $this->assertCount(0, $converter->toRdf($document));
        $this->assertSame(
            "<http://example.com/s> _:b0 \"o\" .\n",
            NQuadsSerializer::serialize($converter->toRdf($document, new ProcessorOptions(produceGeneralizedRdf: true))),
        );
    }

    public function testTheBaseDirectionIsDroppedUnlessAskedFor(): void
    {
        $document = '{"@id": "http://example.com/s", "http://example.com/p": {"@value": "שלום", "@language": "he", "@direction": "rtl"}}';
        $converter = new ToRdfConverter();

        $this->assertSame(
            "<http://example.com/s> <http://example.com/p> \"שלום\"@he .\n",
            NQuadsSerializer::serialize($converter->toRdf($document)),
        );
        $this->assertSame(
            "<http://example.com/s> <http://example.com/p> \"שלום\"^^<https://www.w3.org/ns/i18n#he_rtl> .\n",
            NQuadsSerializer::serialize($converter->toRdf($document, new ProcessorOptions(rdfDirection: RdfVocabulary::RDF_DIRECTION_I18N_DATATYPE))),
        );
        $this->assertCount(4, $converter->toRdf($document, new ProcessorOptions(rdfDirection: RdfVocabulary::RDF_DIRECTION_COMPOUND_LITERAL)));
    }

    public function testAnUnknownRdfDirectionIsRefused(): void
    {
        $options = new ProcessorOptions(rdfDirection: 'sideways');

        try {
            (new ToRdfConverter())->toRdf('{}', $options);
            $this->fail('toRdf accepted an unknown rdfDirection.');
        } catch (JsonLdException) {
        }

        $this->expectException(JsonLdException::class);

        (new FromRdfConverter())->fromRdf('', $options);
    }

    public function testFromRdfHandsBackObjectsWhenAsked(): void
    {
        $document = (new FromRdfConverter())->fromRdf('<http://example.com/s> <http://example.com/p> "o" .', encodeResult: false);

        $this->assertEquals([(object) ['@id' => 'http://example.com/s', 'http://example.com/p' => [(object) ['@value' => 'o']]]], $document);
    }

    public function testFromRdfOrdersTheNodesWhenAsked(): void
    {
        $nQuads = "<http://example.com/b> <http://example.com/p> \"1\" .\n<http://example.com/a> <http://example.com/p> \"2\" .";
        $converter = new FromRdfConverter();

        $this->assertSame(['http://example.com/b', 'http://example.com/a'], array_column($converter->fromRdf($nQuads, encodeResult: false), '@id'));
        $this->assertSame(['http://example.com/a', 'http://example.com/b'], array_column($converter->fromRdf($nQuads, new ProcessorOptions(ordered: true), false), '@id'));
    }

    public function testAnIntegerPhpCannotHoldKeepsItsLexicalForm(): void
    {
        $document = (new FromRdfConverter())->fromRdf(
            <<<'NQUADS'
                <http://example.com/s> <http://example.com/p> "123456789012345678901234567890"^^<http://www.w3.org/2001/XMLSchema#integer> .
                <http://example.com/s> <http://example.com/p> "+007"^^<http://www.w3.org/2001/XMLSchema#integer> .
                NQUADS,
            new ProcessorOptions(useNativeTypes: true),
            false,
        );

        $this->assertEquals(
            [
                (object) ['@value' => '123456789012345678901234567890', '@type' => RdfVocabulary::XSD_INTEGER],
                (object) ['@value' => 7],
            ],
            $document[0]->{'http://example.com/p'},
        );
    }

    #[DataProvider('provideCompoundLiterals')]
    public function testAnIllFormedCompoundLiteralIsRefused(string $nQuads, string $errorCode): void
    {
        $this->expectExceptionObject(new JsonLdException($errorCode));

        (new FromRdfConverter())->fromRdf($nQuads, new ProcessorOptions(rdfDirection: RdfVocabulary::RDF_DIRECTION_COMPOUND_LITERAL));
    }

    /**
     * @return iterable<string, array{string, string}>
     */
    public static function provideCompoundLiterals(): iterable
    {
        $compoundLiteral = <<<'NQUADS'
            <http://example.com/s> <http://example.com/p> _:cl .
            _:cl <http://www.w3.org/1999/02/22-rdf-syntax-ns#value> "v" .
            _:cl <http://www.w3.org/1999/02/22-rdf-syntax-ns#language> "%s" .
            _:cl <http://www.w3.org/1999/02/22-rdf-syntax-ns#direction> "%s" .
            NQUADS;

        yield 'language' => [\sprintf($compoundLiteral, 'not a language', 'rtl'), 'invalid language-tagged string'];
        yield 'direction' => [\sprintf($compoundLiteral, 'en', 'sideways'), 'invalid base direction'];
    }
}
