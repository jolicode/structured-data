<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Validation;

use JoliCode\StructuredData\Extraction\ExtractorFormat;
use JoliCode\StructuredData\Extraction\JsonLdElement;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\AbstractStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ArrayStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ObjectStructure;
use JoliCode\StructuredData\JsonLd\Parser\JsonLdParser;
use JsonStreamingParser\Exception\ParsingException;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * Documents json_decode() refuses go through the streaming parser, which either
 * reports where the document breaks or builds what it could read of it.
 */
#[Group('validation')]
class JsonLdParserTest extends TestCase
{
    public function testAMalformedDocumentReportsWhereItBreaks(): void
    {
        $this->expectException(ParsingException::class);
        $this->expectExceptionMessage('Parsing error in [4:3]. Start of string expected for object key. Instead got: o');

        $this->parse("{\n  \"a\": {\"b\": 1},\n  \"c\": [1, [2]],\n  oops\n}");
    }

    public function testADocumentWithATrailingCommaIsStillRead(): void
    {
        $structure = $this->parse("{\n  \"a\": {\"b\": 1},\n  \"c\": [1, [2]],\n}");

        $this->assertInstanceOf(ObjectStructure::class, $structure);
        $this->assertTrue($structure->hasProperty('a'));
        $this->assertTrue($structure->hasProperty('c'));

        $nested = $structure->getProperty('a')->value?->content;
        $this->assertInstanceOf(ObjectStructure::class, $nested);
        $this->assertTrue($nested->hasProperty('b'));

        $list = $structure->getProperty('c')->value?->content;
        $this->assertInstanceOf(ArrayStructure::class, $list);
        $this->assertCount(2, $list->getValues());
        $this->assertInstanceOf(ArrayStructure::class, $list->getValue(1)->content);

        // The positions are the ones the well-formed document gets from the fast parser.
        $wellFormed = $this->parse("{\n  \"a\": {\"b\": 1},\n  \"c\": [1, [2]]\n}");
        $this->assertInstanceOf(ObjectStructure::class, $wellFormed);

        $this->assertSame('11:5 to 14:2', $this->range($structure));
        $this->assertSame('12:8 to 12:16', $this->range($nested));
        $this->assertSame('13:8 to 13:16', $this->range($list));
        $this->assertSame($this->range($wellFormed), $this->range($structure));
        $this->assertSame($this->range($wellFormed->getProperty('a')->value?->content), $this->range($nested));
        $this->assertSame($this->range($wellFormed->getProperty('c')->value?->content), $this->range($list));
    }

    public function testColumnsCountUtf16CodeUnits(): void
    {
        // The emoji takes two columns, as in a browser editor; both parsers agree.
        foreach (['{"a":"🙂","b":"x"}', '{"a":"🙂","b":"x",}'] as $content) {
            $structure = $this->parse($content);
            $this->assertInstanceOf(ObjectStructure::class, $structure);

            $property = $structure->getProperty('b');
            $this->assertSame('11:16 to 11:17', $property->key->range->start . ' to ' . $property->key->range->end, $content);
            $this->assertSame('11:20 to 11:21', $property->value?->range->start . ' to ' . $property->value?->range->end, $content);
        }
    }

    private function range(mixed $structure): string
    {
        $this->assertInstanceOf(AbstractStructure::class, $structure);

        return $structure->range?->start . ' to ' . $structure->range?->end;
    }

    private function parse(string $content): mixed
    {
        return (new JsonLdParser())->parse(new JsonLdElement(10, 4, $content, ExtractorFormat::JSONLD));
    }
}
