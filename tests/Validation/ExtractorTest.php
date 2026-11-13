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

use JoliCode\StructuredData\Extraction\Extractor;
use JoliCode\StructuredData\Extraction\ExtractorsContainer;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('validation')]
class ExtractorTest extends TestCase
{
    public function testItExtractsAllSupportedFormatsPresentInTheDocument(): void
    {
        $extractor = new Extractor();

        $document = <<<'HTML'
<!doctype html>
<html>
  <body>
    <script type="application/ld+json">
      {"@context":"https://schema.org","@type":"Person","name":"JsonLd Person"}
    </script>
    <div itemscope itemtype="https://schema.org/Person">
      <span itemprop="name">Microdata Person</span>
    </div>
    <div vocab="https://schema.org/" typeof="Person">
      <span property="name">RDFa Person</span>
    </div>
  </body>
</html>
HTML;

        $elements = $extractor->extract($document);

        $this->assertCount(3, $elements);
        $this->assertStringContainsString('JsonLd Person', $elements[0]->content);
        $this->assertStringContainsString('"name":"Microdata Person"', $elements[1]->content);
        $this->assertStringContainsString('"name":"RDFa Person"', $elements[2]->content);
    }

    public function testItFallsBackToMicrodataWhenNoJsonLdIsPresent(): void
    {
        $extractor = new Extractor();

        $document = <<<'HTML'
<!doctype html>
<html>
  <body>
    <article itemscope itemtype="https://schema.org/Person">
      <h1 itemprop="name">Jane Doe</h1>
    </article>
  </body>
</html>
HTML;

        $elements = $extractor->extract($document);

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"@type":"Person"', $elements[0]->content);
        $this->assertStringContainsString('"name":"Jane Doe"', $elements[0]->content);
    }

    public function testItExtractsEachTopLevelMicrodataItemAsASeparateElement(): void
    {
        $extractor = new Extractor();

        $document = <<<'HTML'
<!doctype html>
<html>
  <body>
    <article itemscope itemtype="https://schema.org/Person">
      <h1 itemprop="name">Jane Doe</h1>
    </article>
    <article itemscope itemtype="https://schema.org/Organization">
      <h1 itemprop="name">Acme Org</h1>
    </article>
  </body>
</html>
HTML;

        $elements = $extractor->extract($document);

        $this->assertCount(2, $elements);
        $this->assertStringContainsString('"name":"Jane Doe"', $elements[0]->content);
        $this->assertStringContainsString('"name":"Acme Org"', $elements[1]->content);
    }

    public function testItExtractsATopLevelMicrodataItemNestedInAnotherItemsElement(): void
    {
        // A BreadcrumbList without itemprop, inside the VideoObject's element: it
        // is a top-level item of its own, and the VideoObject gets none of its
        // properties.
        $extractor = new Extractor();

        $document = <<<'HTML'
<!doctype html>
<html>
  <body>
    <div itemscope itemtype="https://schema.org/VideoObject">
      <meta itemprop="name" content="A video">
      <span itemscope itemtype="https://schema.org/BreadcrumbList">
        <span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
          <meta itemprop="position" content="1">
          <meta itemprop="name" content="A channel">
        </span>
      </span>
    </div>
  </body>
</html>
HTML;

        $elements = $extractor->extract($document);

        $this->assertCount(2, $elements);
        $this->assertStringContainsString('"@type":"VideoObject"', $elements[0]->content);
        $this->assertStringContainsString('"name":"A video"', $elements[0]->content);
        $this->assertStringNotContainsString('itemListElement', $elements[0]->content);
        $this->assertStringContainsString('"@type":"BreadcrumbList"', $elements[1]->content);
        $this->assertStringContainsString('"name":"A channel"', $elements[1]->content);
    }

    public function testItReadsTheContentAttributeOfAnyMicrodataPropertyElement(): void
    {
        // The specification only defines "content" on <meta>, but Google reads it
        // everywhere, and real pages name authors with <link itemprop content>.
        $extractor = new Extractor();

        $document = <<<'HTML'
<!doctype html>
<html>
  <body>
    <div itemscope itemtype="https://schema.org/VideoObject">
      <span itemprop="author" itemscope itemtype="https://schema.org/Person">
        <link itemprop="url" href="https://example.com/@channel">
        <link itemprop="name" content="Rick Astley">
      </span>
      <span itemprop="genre" content="Music">Pop</span>
    </div>
  </body>
</html>
HTML;

        $elements = $extractor->extract($document);

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"url":"https://example.com/@channel"', $elements[0]->content);
        $this->assertStringContainsString('"name":"Rick Astley"', $elements[0]->content);
        $this->assertStringContainsString('"genre":"Music"', $elements[0]->content);
    }

    public function testItFallsBackToRdfaWhenNoJsonLdOrMicrodataIsPresent(): void
    {
        $extractor = new Extractor();

        $document = <<<'HTML'
<!doctype html>
<html>
  <body>
    <article vocab="https://schema.org/" typeof="Person">
      <h1 property="name">RDFa Jane</h1>
    </article>
  </body>
</html>
HTML;

        $elements = $extractor->extract($document);

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"@type":"Person"', $elements[0]->content);
        $this->assertStringContainsString('"name":"RDFa Jane"', $elements[0]->content);
    }

    public function testItFallsBackWhenPreferredExtractorThrows(): void
    {
        $extractor = (new Extractor())->setExtractors(
            ExtractorsContainer::JSONLD,
            ExtractorsContainer::MICRODATA,
        );

        $document = <<<'HTML'
    <!doctype html>
    <html>
      <body>
        <script type="application/ld+json">{"@context":"https://schema.org",</script>
      <article itemscope itemtype="https://schema.org/Person">
        <h1 itemprop="name">Jane Doe</h1>
      </article>
      </body>
    </html>
    HTML;

        $elements = $extractor->extract($document);

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"@type":"Person"', $elements[0]->content);
    }

    public function testItSurfacesExceptionWhenAllConfiguredExtractorsFail(): void
    {
        $extractor = (new Extractor())->setExtractors(
            ExtractorsContainer::JSONLD,
            ExtractorsContainer::MICRODATA,
        );

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid JSON-LD document: found JSON-LD script tags but could not extract usable content');

        $extractor->extract('<html><body><script type="application/ld+json">{"@context":"https://schema.org",</script><div itemscope><span itemprop="name">Jane Doe</span></div></body></html>');
    }

    public function testItCanRestrictTheConfiguredExtractors(): void
    {
        $extractor = (new Extractor())->setExtractors(ExtractorsContainer::MICRODATA);

        $document = <<<'HTML'
<!doctype html>
<html>
  <body>
    <script type="application/ld+json">
      {"@context":"https://schema.org","@type":"Person","name":"JsonLd Person"}
    </script>
    <article itemscope itemtype="https://schema.org/Person">
      <h1 itemprop="name">Microdata Jane</h1>
    </article>
  </body>
</html>
HTML;

        $elements = $extractor->extract($document);

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"name":"Microdata Jane"', $elements[0]->content);
    }

    public function testItRejectsUnknownConfiguredExtractors(): void
    {
        $extractor = new Extractor();

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Unknown extractor "nope". Supported extractors are: jsonld, microdata, rdfa.');

        $extractor->setExtractors('nope');
    }

    public function testItIgnoresDuplicateConfiguredExtractors(): void
    {
        $extractor = new Extractor();

        $extractor->setExtractors(ExtractorsContainer::JSONLD, ExtractorsContainer::JSONLD);

        $elements = $extractor->extract('<html><body><script type="application/ld+json">{"@context":"https://schema.org","@type":"Person","name":"Jane"}</script></body></html>');

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"name":"Jane"', $elements[0]->content);
    }

    #[DataProvider('provideScriptTagsWithAnUnquotedType')]
    public function testItExtractsJsonLdFromAScriptTagWithAnUnquotedType(string $openingTag): void
    {
        $elements = (new Extractor())->extract('<!doctype html><html><head>' . $openingTag . '{"@context":"https://schema.org","@type":"Person","name":"Jane"}</script></head><body></body></html>');

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"name":"Jane"', $elements[0]->content);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideScriptTagsWithAnUnquotedType(): iterable
    {
        yield 'type only' => ['<script type=application/ld+json>'];
        yield 'followed by another attribute' => ['<script type=application/ld+json id=data>'];
        yield 'preceded by another attribute' => ['<script id=data type=application/ld+json>'];
        yield 'whitespace around the equals sign' => ['<script type = "application/ld+json">'];
    }

    #[DataProvider('provideScriptTagsThatAreNotJsonLd')]
    public function testItIgnoresScriptTagsThatAreNotJsonLd(string $openingTag): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Could not detect any supported structured data format.');

        (new Extractor())->extract('<html><body>' . $openingTag . '{"@context":"https://schema.org","@type":"Person","name":"Jane"}</script></body></html>');
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideScriptTagsThatAreNotJsonLd(): iterable
    {
        yield 'unquoted type only starting with the JSON-LD media type' => ['<script type=application/ld+jsonp>'];
        yield 'media type in another attribute' => ['<script data-type="application/ld+json">'];
        yield 'mismatched quotes' => ['<script type="application/ld+json\'>'];
    }

    public function testItSurfacesAGenericExceptionWhenNoSupportedFormatIsDetected(): void
    {
        $extractor = new Extractor();

        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Could not detect any supported structured data format. Supported formats are: jsonld, microdata, rdfa.');

        $extractor->extract('<html><body><p>Hello world</p></body></html>');
    }
}
