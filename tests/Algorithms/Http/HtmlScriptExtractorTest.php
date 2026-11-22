<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms\Http;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\DocumentLoadingException;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HtmlScriptExtractor;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\LoadDocumentOptions;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('algorithms')]
class HtmlScriptExtractorTest extends TestCase
{
    private const PAGE = <<<'HTML'
        <!DOCTYPE html>
        <html>
          <head>
            <script>var notJsonLd = {"a": 1};</script>
            <script id="first" type="application/ld+json">{"name": "first"}</script>
            <script id="second" type="APPLICATION/LD+JSON; charset=utf-8">[{"name": "second"}, {"name": "third"}]</script>
            <script id="context" type="application/ld+json;profile=http://www.w3.org/ns/json-ld#context">{"@context": {"name": "http://example.com/name"}}</script>
            <script id="other" type="application/json">{"name": "not JSON-LD"}</script>
          </head>
          <body><p id="paragraph">text</p></body>
        </html>
        HTML;

    public function testTheFirstScriptIsExtractedByDefault(): void
    {
        $extracted = (new HtmlScriptExtractor())->extract(self::PAGE);

        $this->assertEquals((object) ['name' => 'first'], $extracted['document']);
        $this->assertNull($extracted['base']);
    }

    public function testEveryScriptIsExtractedWhenAskedAndArraysAreMerged(): void
    {
        $extracted = (new HtmlScriptExtractor())->extract(self::PAGE, options: new LoadDocumentOptions(extractAllScripts: true));

        $this->assertEquals(
            [
                (object) ['name' => 'first'],
                (object) ['name' => 'second'],
                (object) ['name' => 'third'],
                (object) ['@context' => (object) ['name' => 'http://example.com/name']],
            ],
            $extracted['document'],
        );
    }

    public function testAFragmentTargetsOneScriptWhateverTheOtherOptions(): void
    {
        $extracted = (new HtmlScriptExtractor())->extract(self::PAGE, 'second', new LoadDocumentOptions(extractAllScripts: true));

        $this->assertEquals([(object) ['name' => 'second'], (object) ['name' => 'third']], $extracted['document']);
    }

    public function testAFragmentIsPercentDecoded(): void
    {
        $page = '<script id="é a" type="application/ld+json">{"name": "accent"}</script>';

        $this->assertEquals((object) ['name' => 'accent'], (new HtmlScriptExtractor())->extract($page, '%C3%A9%20a')['document']);
    }

    #[DataProvider('provideFragmentsThatAreNotAJsonLdScript')]
    public function testAFragmentThatIsNotAJsonLdScriptIsRefused(string $fragment): void
    {
        $this->expectExceptionObject(new DocumentLoadingException('loading document failed'));

        (new HtmlScriptExtractor())->extract(self::PAGE, $fragment);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideFragmentsThatAreNotAJsonLdScript(): iterable
    {
        yield 'no such element' => ['missing'];
        yield 'not a script' => ['paragraph'];
        yield 'a script of another type' => ['other'];
    }

    public function testAProfileSelectsTheScriptThatDeclaresIt(): void
    {
        $extracted = (new HtmlScriptExtractor())->extract(self::PAGE, options: LoadDocumentOptions::forContext());

        $this->assertEquals((object) ['@context' => (object) ['name' => 'http://example.com/name']], $extracted['document']);
    }

    public function testAProfileNoScriptDeclaresFallsBackToTheFirstScript(): void
    {
        $extracted = (new HtmlScriptExtractor())->extract(self::PAGE, options: new LoadDocumentOptions(profile: 'http://example.com/profile'));

        $this->assertEquals((object) ['name' => 'first'], $extracted['document']);
    }

    public function testAPageWithoutScriptIsRefusedUnlessEveryScriptIsAskedFor(): void
    {
        $extractor = new HtmlScriptExtractor();

        $this->assertSame([], $extractor->extract('<html><head></head></html>', options: new LoadDocumentOptions(extractAllScripts: true))['document']);

        $this->expectExceptionObject(new DocumentLoadingException('loading document failed'));

        $extractor->extract('<html><head></head></html>');
    }

    #[DataProvider('provideInvalidScripts')]
    public function testAScriptThatIsNotAJsonDocumentIsRefused(string $content): void
    {
        $this->expectExceptionObject(new DocumentLoadingException('invalid script element'));

        (new HtmlScriptExtractor())->extract(\sprintf('<script type="application/ld+json">%s</script>', $content));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideInvalidScripts(): iterable
    {
        yield 'not JSON' => ['{"name": }'];
        yield 'a comment around the JSON' => ['<!-- {"name": "commented"} -->'];
        yield 'a scalar' => ['"just a string"'];
        yield 'empty' => [''];
    }

    public function testTheTextOfAScriptIsTakenAsItIsWritten(): void
    {
        $page = '<script type="application/ld+json">{"name": "café ☕ &lt;&amp;&gt; <b>bold</b>"}</script>';

        $this->assertEquals((object) ['name' => 'café ☕ &lt;&amp;&gt; <b>bold</b>'], (new HtmlScriptExtractor())->extract($page)['document']);
    }

    public function testTheBaseElementIsHandedBackAsWritten(): void
    {
        $page = '<html><head><base href="../base/"><script type="application/ld+json">{}</script></head></html>';

        $this->assertSame('../base/', (new HtmlScriptExtractor())->extract($page)['base']);
    }
}
