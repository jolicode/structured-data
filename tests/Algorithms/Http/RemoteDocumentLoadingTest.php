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

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\ContextProcessingException;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\DocumentLoadingException;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HttpDocumentLoader;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\LoadDocumentOptions;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\RemoteContextPolicy;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

/**
 * What a document loaded from a URL is, beyond what the W3C remote-doc and html
 * suites ask: the answers below are the ones a server may give.
 */
#[Group('algorithms')]
class RemoteDocumentLoadingTest extends TestCase
{
    #[DataProvider('provideAcceptedContentTypes')]
    public function testJsonContentTypesAreAccepted(string $contentType, string $expectedContentType, ?string $expectedProfile): void
    {
        $document = $this->loader(['https://example.com/doc' => ['{"name": "doc"}', $contentType]])->load('https://example.com/doc');

        $this->assertEquals((object) ['name' => 'doc'], $document->document);
        $this->assertSame($expectedContentType, $document->contentType);
        $this->assertSame($expectedProfile, $document->profile);
        $this->assertSame('https://example.com/doc', $document->documentUrl);
    }

    /**
     * @return iterable<string, array{string, string, string|null}>
     */
    public static function provideAcceptedContentTypes(): iterable
    {
        yield 'JSON-LD' => ['application/ld+json', 'application/ld+json', null];
        yield 'JSON' => ['application/json', 'application/json', null];
        yield 'a +json type' => ['application/activity+json', 'application/activity+json', null];
        yield 'parameters and case' => ['Application/LD+JSON; charset=utf-8; profile="http://www.w3.org/ns/json-ld#expanded"', 'application/ld+json', 'http://www.w3.org/ns/json-ld#expanded'];
    }

    #[DataProvider('provideRefusedContentTypes')]
    public function testAnyOtherContentTypeIsRefusedEvenWhenTheBodyIsJson(?string $contentType): void
    {
        $this->expectExceptionObject(new DocumentLoadingException('loading document failed'));

        $this->loader(['https://example.com/doc' => ['{"name": "doc"}', $contentType]])->load('https://example.com/doc');
    }

    /**
     * @return iterable<string, array{string|null}>
     */
    public static function provideRefusedContentTypes(): iterable
    {
        yield 'plain text' => ['text/plain'];
        yield 'binary' => ['application/octet-stream'];
        yield 'javascript' => ['application/javascript'];
        yield 'no content type' => [null];
    }

    public function testAJsonDocumentThatIsAnArrayStaysAnArray(): void
    {
        $document = $this->loader(['https://example.com/doc' => ['[{"name": "a"}, {"name": "b"}]', 'application/ld+json']])->load('https://example.com/doc');

        $this->assertEquals([(object) ['name' => 'a'], (object) ['name' => 'b']], $document->document);
    }

    public function testAJsonBodyThatIsNotADocumentIsRefused(): void
    {
        $this->expectExceptionObject(new DocumentLoadingException('loading document failed'));

        $this->loader(['https://example.com/doc' => ['"a string"', 'application/ld+json']])->load('https://example.com/doc');
    }

    public function testTheDocumentUrlIsWhereARedirectionLeads(): void
    {
        $loader = $this->loader([
            'https://example.com/old' => ['', null, [], 301, 'https://example.com/new/doc'],
            'https://example.com/new/doc' => ['{"@id": ""}', 'application/ld+json'],
        ]);

        $this->assertSame('https://example.com/new/doc', $loader->load('https://example.com/old')->documentUrl);
    }

    public function testTheContextOfAJsonDocumentIsResolvedAgainstItsLocation(): void
    {
        $document = $this->loader(['https://example.com/a/doc' => ['{}', 'application/json', ['<../context.jsonld>; rel="http://www.w3.org/ns/json-ld#context"']]])->load('https://example.com/a/doc');

        $this->assertSame('https://example.com/context.jsonld', $document->contextUrl);
    }

    public function testTheContextLinkOfAJsonLdDocumentIsIgnored(): void
    {
        $document = $this->loader(['https://example.com/doc' => ['{}', 'application/ld+json', ['<context.jsonld>; rel="http://www.w3.org/ns/json-ld#context"']]])->load('https://example.com/doc');

        $this->assertNull($document->contextUrl);
    }

    public function testSeveralContextLinksAreRefused(): void
    {
        $this->expectExceptionObject(new DocumentLoadingException('multiple context link headers'));

        $this->loader(['https://example.com/doc' => ['{}', 'application/json', [
            '<a.jsonld>; rel="http://www.w3.org/ns/json-ld#context"',
            '<b.jsonld>; rel="http://www.w3.org/ns/json-ld#context"',
        ]]])->load('https://example.com/doc');
    }

    public function testAnAlternateLinkIsFollowedFromADocumentThatIsNotJson(): void
    {
        $loader = $this->loader([
            'https://example.com/page' => ['<html></html>', 'text/html', ['<data/doc.jsonld>; rel="alternate"; type="application/ld+json"']],
            'https://example.com/data/doc.jsonld' => ['{"name": "alternate"}', 'application/ld+json'],
        ]);

        $document = $loader->load('https://example.com/page');

        $this->assertEquals((object) ['name' => 'alternate'], $document->document);
        $this->assertSame('https://example.com/data/doc.jsonld', $document->documentUrl);
    }

    public function testAnAlternateLinkIsNotFollowedFromAJsonDocument(): void
    {
        $loader = $this->loader([
            'https://example.com/doc.json' => ['{"name": "json"}', 'application/json', ['<doc.jsonld>; rel="alternate"; type="application/ld+json"']],
            'https://example.com/doc.jsonld' => ['{"name": "alternate"}', 'application/ld+json'],
        ]);

        $this->assertEquals((object) ['name' => 'json'], $loader->load('https://example.com/doc.json')->document);
    }

    public function testAnHtmlDocumentHandsItsScriptAndItsBase(): void
    {
        $page = '<html><head><base href="/base/"><script type="application/ld+json">{"name": "first"}</script><script id="two" type="application/ld+json">{"name": "second"}</script></head></html>';
        $loader = $this->loader(['https://example.com/page' => [$page, 'text/html; charset=utf-8']]);

        $first = $loader->load('https://example.com/page');
        $this->assertEquals((object) ['name' => 'first'], $first->document);
        $this->assertSame('text/html', $first->contentType);
        $this->assertSame('/base/', $first->htmlBase);
        $this->assertSame('https://example.com/page', $first->documentUrl);

        $this->assertEquals((object) ['name' => 'second'], $loader->load('https://example.com/page#two')->document);
        $this->assertCount(2, (array) $loader->load('https://example.com/page', new LoadDocumentOptions(extractAllScripts: true))->document);
    }

    public function testADocumentIsAskedAsJsonLdThenJsonThenHtml(): void
    {
        $accept = [];
        $loader = $this->loader(['https://example.com/doc' => ['{}', 'application/ld+json']], $accept);

        $loader->load('https://example.com/doc');
        $loader->load('https://example.com/doc', LoadDocumentOptions::forContext());

        $this->assertSame([
            'application/ld+json,application/json;q=0.9,text/html;q=0.8,application/xhtml+xml;q=0.8,*/*;q=0.1',
            'application/ld+json;profile="http://www.w3.org/ns/json-ld#context",application/json;q=0.9,*/*;q=0.1',
        ], $accept);
    }

    public function testTheBaseOptionTakesPrecedenceOverTheLocationOfTheDocument(): void
    {
        $loader = $this->loader(['https://example.com/dir/doc' => ['{"@id": "relative", "http://example.com/p": "v"}', 'application/ld+json']]);

        $expander = new Expander(documentLoader: $loader);
        $expected = static fn (string $identifier): array => [(object) ['@id' => $identifier, 'http://example.com/p' => [(object) ['@value' => 'v']]]];

        $this->assertEquals($expected('https://example.com/dir/relative'), $expander->expand('https://example.com/dir/doc', encodeResult: false));
        $this->assertEquals($expected('https://other.example/relative'), $expander->expand('https://example.com/dir/doc', new ProcessorOptions(base: 'https://other.example/'), false));
    }

    public function testAUrlIsGivenAsItIsOrAsAJsonString(): void
    {
        $loader = $this->loader(['https://example.com/doc' => ['{"http://example.com/p": "v"}', 'application/ld+json']]);
        $expander = new Expander(documentLoader: $loader);

        $this->assertSame($expander->expand('https://example.com/doc'), $expander->expand('"https://example.com/doc"'));
    }

    public function testTheLinkedContextComesBeforeTheOneOfTheDocument(): void
    {
        $loader = $this->loader([
            'https://example.com/doc' => ['{"@context": {"b": "http://example.com/own-b"}, "a": "1", "b": "2"}', 'application/json', ['<context>; rel="http://www.w3.org/ns/json-ld#context"']],
            'https://example.com/context' => ['{"@context": {"a": "http://example.com/linked-a", "b": "http://example.com/linked-b"}}', 'application/ld+json'],
        ]);

        $expanded = (new Expander(documentLoader: $loader))->expand('https://example.com/doc', encodeResult: false);

        $this->assertEquals([(object) [
            'http://example.com/linked-a' => [(object) ['@value' => '1']],
            'http://example.com/own-b' => [(object) ['@value' => '2']],
        ]], $expanded);
    }

    public function testADocumentThatCannotBeLoadedAndAContextThatCannotBeLoadedHaveDifferentNames(): void
    {
        $loader = $this->loader(['https://example.com/doc' => ['{"@context": "https://example.com/missing"}', 'application/ld+json']]);
        $expander = new Expander(documentLoader: $loader);

        try {
            $expander->expand('https://example.com/nowhere');
            $this->fail('A missing document was loaded.');
        } catch (JsonLdException $exception) {
            $this->assertSame('loading document failed', $exception->getMessage());
        }

        $this->expectExceptionObject(new ContextProcessingException('loading remote context failed'));

        $expander->expand('https://example.com/doc');
    }

    /**
     * @param array<string, array{0: string, 1: string|null, 2?: list<string>, 3?: int, 4?: string}> $pages  body, content type, Link headers, status and Location per URL
     * @param list<string>                                                                           $accept filled with the Accept header of every request
     */
    private function loader(array $pages, array &$accept = []): HttpDocumentLoader
    {
        $client = new MockHttpClient(static function (string $method, string $url, array $options) use ($pages, &$accept): MockResponse {
            $accept[] = $options['normalized_headers']['accept'][0] ?? '';
            $accept[array_key_last($accept)] = (string) preg_replace('/^Accept: /i', '', $accept[array_key_last($accept)]);

            if (!\array_key_exists($url, $pages)) {
                return new MockResponse('not here', ['http_code' => 404]);
            }

            $page = $pages[$url];
            $headers = [];

            if (null !== $page[1]) {
                $headers['Content-Type'] = $page[1];
            }

            if ([] !== ($page[2] ?? [])) {
                $headers['Link'] = $page[2];
            }

            if (isset($page[4])) {
                $headers['Location'] = $page[4];
            }

            return new MockResponse($page[0], ['http_code' => $page[3] ?? 200, 'response_headers' => $headers]);
        });

        return new HttpDocumentLoader(RemoteContextPolicy::allowHosts('example.com', 'other.example'), $client);
    }
}
