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

use JoliCode\StructuredData\Extraction\FormatExtractorInterface;
use JoliCode\StructuredData\Extraction\JsonLdNodeExtractor;
use JoliCode\StructuredData\Extraction\MicrodataExtractor;
use JoliCode\StructuredData\Extraction\RdfaExtractor;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\AbstractStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ArrayStructure;
use JoliCode\StructuredData\JsonLd\Parser\DataStructures\ObjectStructure;
use JoliCode\StructuredData\JsonLd\Parser\JsonLdParser;
use JoliCode\StructuredData\JsonLd\Parser\Range;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * The positions reported for documents built from HTML markup point at that
 * markup: the key of a property at its name in the attribute declaring it, its
 * value at the attribute or the text it is read from. Columns count UTF-16 code
 * units, as the editors displaying them do.
 */
#[Group('validation')]
class HtmlSourcePositionTest extends TestCase
{
    public function testMicrodataKeysAndValuesPointAtTheMarkup(): void
    {
        $document = <<<'HTML'
<!DOCTYPE html>
<html lang="en">
<body>
  <div itemscope itemtype="https://schema.org/Person">
    <h1 itemprop="name">Jane Doe</h1>
    <p itemprop="jobTitle">Web developer</p>
    <a itemprop="url" href="https://example.com/team/jane-doe">Profile</a>
    <div itemprop="worksFor" itemscope itemtype="https://schema.org/Organization">
      <span itemprop="name">Example</span>
      <span itemprop="foundingYear"> 2010 </span>
    </div>
  </div>
</body>
</html>
HTML;

        $located = $this->locate(new MicrodataExtractor(), $document);

        $this->assertSame('itemtype', $located['/@type']['key']);
        $this->assertSame('https://schema.org/Person', $located['/@type']['value']);
        $this->assertSame('<div itemscope itemtype="https://schema.org/Person">', $located['/@context']['value']);
        $this->assertSame('name', $located['/name']['key']);
        $this->assertSame('Jane Doe', $located['/name']['value']);
        $this->assertSame('jobTitle', $located['/jobTitle']['key']);
        $this->assertSame('Web developer', $located['/jobTitle']['value']);
        $this->assertSame('url', $located['/url']['key']);
        $this->assertSame('https://example.com/team/jane-doe', $located['/url']['value']);
        $this->assertSame('worksFor', $located['/worksFor']['key']);
        $this->assertSame('<div itemprop="worksFor" itemscope itemtype="https://schema.org/Organization">', $located['/worksFor']['value']);
        $this->assertSame('foundingYear', $located['/worksFor/foundingYear']['key']);
        // the text alone, without the whitespace around it
        $this->assertSame('2010', $located['/worksFor/foundingYear']['value']);
        $this->assertSame('10:38-10:42', $located['/worksFor/foundingYear']['valueRange']);
    }

    public function testEachValueOfARepeatedPropertyPointsAtItsOwnMarkup(): void
    {
        $document = <<<'HTML'
<div itemscope itemtype="https://schema.org/Recipe">
  <img itemprop="image" src="1.jpg"><img itemprop="image" src="2.jpg"><img itemprop="image" src="3.jpg">
  <ol>
    <li itemprop="recipeInstructions">Step 1<b itemprop="keywords">k1</b></li>
    <li itemprop="recipeInstructions">Step 2</li>
  </ol>
  <span itemprop="keywords">k2</span>
</div>
HTML;

        $located = $this->locate(new MicrodataExtractor(), $document);

        $this->assertSame('1.jpg', $located['/image/0']['value']);
        $this->assertSame('2:64-2:69', $located['/image/1']['valueRange']);
        $this->assertSame('2.jpg', $located['/image/1']['value']);
        $this->assertSame('k2', $located['/keywords/1']['value']);
    }

    public function testRdfaKeysAndValuesPointAtTheMarkup(): void
    {
        $document = <<<'HTML'
<div vocab="https://schema.org/" typeof="Person" resource="#jane">
  <span property="og:title name">Jane Doe</span>
  <a property="url" href="https://example.com">site</a>
  <span property="knowsLanguage">fr</span><span property="knowsLanguage">en</span>
</div>
HTML;

        $located = $this->locate(new RdfaExtractor(), $document);

        $this->assertSame('typeof', $located['/@type']['key']);
        $this->assertSame('Person', $located['/@type']['value']);
        $this->assertSame('resource', $located['/@id']['key']);
        $this->assertSame('#jane', $located['/@id']['value']);
        $this->assertSame('name', $located['/name']['key']);
        $this->assertSame('Jane Doe', $located['/name']['value']);
        $this->assertSame('https://example.com', $located['/url']['value']);
        $this->assertSame('fr', $located['/knowsLanguage/0']['value']);
        $this->assertSame('en', $located['/knowsLanguage/1']['value']);
    }

    public function testColumnsCountUtf16CodeUnits(): void
    {
        $document = <<<'HTML'
<div itemscope itemtype="https://schema.org/Person"><span>🙂</span><span itemprop="name">Jane</span></div>
HTML;

        $located = $this->locate(new MicrodataExtractor(), $document);

        // the emoji takes two columns, as in a browser editor: "Jane" starts on
        // the 90th code unit, the 89th character
        $this->assertSame('1:90-1:94', $located['/name']['valueRange']);
        $this->assertSame('Jane', $located['/name']['value']);

        $jsonLd = '<p>🙂</p><script type="application/ld+json">{"@context":"https://schema.org","@type":"Person","name":"🙂 Jane"}</script>';
        $located = $this->locate(new JsonLdNodeExtractor(), $jsonLd);

        $this->assertSame('🙂 Jane', $located['/name']['value']);
    }

    public function testIdenticalItemsOnOneLineKeepTheirOwnPositions(): void
    {
        $item = '<div itemscope itemtype="https://schema.org/Thing"><span itemprop="name">Same</span></div>';
        $extractor = new MicrodataExtractor();
        $parser = new JsonLdParser();
        $elements = $extractor->extractStructuredDataContent($item . $item);

        $this->assertCount(2, $elements);
        $this->assertSame($elements[0]->content, $elements[1]->content);

        $first = $parser->parse($elements[0]);
        $second = $parser->parse($elements[1]);

        $this->assertInstanceOf(ObjectStructure::class, $first);
        $this->assertInstanceOf(ObjectStructure::class, $second);
        $this->assertSame('1:74', (string) $first->getProperty('name')->value?->range->start);
        $this->assertSame('1:' . (74 + \strlen($item)), (string) $second->getProperty('name')->value?->range->start);
    }

    public function testMarkupOutsideTheDocumentTreeDoesNotShiftPositions(): void
    {
        $document = <<<'HTML'
<!-- <span itemprop="name">commented</span> --><template><span itemprop="name">template</span></template><script>var s = '<span itemprop="name">script</span>';</script>
<div itemscope itemtype="https://schema.org/Thing"><span itemprop="name">Real</span></div>
HTML;

        $located = $this->locate(new MicrodataExtractor(), $document);

        $this->assertSame('Real', $located['/name']['value']);
        $this->assertSame('name', $located['/name']['key']);
    }

    public function testAnElementWhoseTextCannotBeLocatedFallsBackOnItsStartTag(): void
    {
        $document = <<<'HTML'
<div itemscope itemtype="https://schema.org/Thing">
  <p itemprop="description">No end tag
</div>
HTML;

        $located = $this->locate(new MicrodataExtractor(), $document);

        $this->assertSame('<p itemprop="description">', $located['/description']['value']);
    }

    public function testMalformedMarkupIsLocatedTolerantly(): void
    {
        $document = <<<'HTML'
</stray><div itemscope itemtype=https://schema.org/Thing ><span itemprop = 'name' >Jane</span></b>
<span itemprop="description">Unclosed
HTML;

        $located = $this->locate(new MicrodataExtractor(), $document);

        $this->assertSame('https://schema.org/Thing', $located['/@type']['value']);
        $this->assertSame('name', $located['/name']['key']);
        $this->assertSame('Jane', $located['/name']['value']);
        $this->assertSame('<span itemprop="description">', $located['/description']['value']);
    }

    public function testWindowsLineBreaksCountAsOneLine(): void
    {
        $document = "<div itemscope itemtype=\"https://schema.org/Thing\">\r\n  <span itemprop=\"name\">Jane</span>\r\n</div>";

        $located = $this->locate(new MicrodataExtractor(), $document);

        $this->assertSame('2:25-2:29', $located['/name']['valueRange']);
    }

    /**
     * Parses the first document extracted from $document, and reads back, for
     * each JSON pointer, the source text its key and value ranges cover.
     *
     * @return array<string, array<string, string>>
     */
    private function locate(FormatExtractorInterface $extractor, string $document): array
    {
        $elements = $extractor->extractStructuredDataContent($document);
        $this->assertNotEmpty($elements);

        $structure = (new JsonLdParser())->parse($elements[0]);
        $this->assertNotNull($structure);

        $lines = preg_split('/\r\n|\r|\n/', $document) ?: [];
        $located = [];
        $this->collect($structure, '', $lines, $located);

        return $located;
    }

    /**
     * @param list<string>                         $lines
     * @param array<string, array<string, string>> $located
     */
    private function collect(AbstractStructure $structure, string $pointer, array $lines, array &$located): void
    {
        if ($structure instanceof ObjectStructure) {
            foreach ($structure->getProperties() as $name => $property) {
                $propertyPointer = $pointer . '/' . $name;
                $located[$propertyPointer]['key'] = $this->read($lines, $property->key->range);

                if (null === $property->value) {
                    continue;
                }

                $located[$propertyPointer]['value'] = $this->read($lines, $property->value->range);
                $located[$propertyPointer]['valueRange'] = $property->value->range->start . '-' . $property->value->range->end;

                if ($property->value->content instanceof AbstractStructure) {
                    $this->collect($property->value->content, $propertyPointer, $lines, $located);
                }
            }
        } elseif ($structure instanceof ArrayStructure) {
            foreach ($structure->getValues() as $index => $value) {
                $valuePointer = $pointer . '/' . $index;
                $located[$valuePointer]['value'] = $this->read($lines, $value->range);
                $located[$valuePointer]['valueRange'] = $value->range->start . '-' . $value->range->end;

                if ($value->content instanceof AbstractStructure) {
                    $this->collect($value->content, $valuePointer, $lines, $located);
                }
            }
        }
    }

    /**
     * Reads the text a single-line range covers, counting columns in UTF-16
     * code units.
     *
     * @param list<string> $lines
     */
    private function read(array $lines, Range $range): string
    {
        $this->assertNotNull($range->start);
        $this->assertNotNull($range->end);
        $this->assertSame($range->start->line, $range->end->line, 'The range spans one line.');

        $line = mb_convert_encoding($lines[$range->start->line - 1] ?? '', 'UTF-16LE', 'UTF-8');
        $slice = substr($line, ($range->start->column - 1) * 2, ($range->end->column - $range->start->column) * 2);

        return mb_convert_encoding($slice, 'UTF-8', 'UTF-16LE');
    }
}
