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
use JoliCode\StructuredData\JsonLd\Algorithms\Http\HttpDocumentLoader;
use JoliCode\StructuredData\JsonLd\Algorithms\Http\RemoteContextPolicy;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

#[Group('security')]
class HttpDocumentLoaderTest extends TestCase
{
    public function testTheDefaultPolicyRefusesEveryHostWithoutIssuingARequest(): void
    {
        $loader = new HttpDocumentLoader(httpClient: $this->clientThatMustNotBeCalled());

        $this->expectException(ContextProcessingException::class);
        $this->expectExceptionMessage('loading remote context failed');

        $loader->load('https://example.com/context.jsonld');
    }

    public function testAnAllowedHostIsFetched(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            new MockHttpClient(new MockResponse('{"@context":{"name":"https://schema.org/name"}}')),
        );

        $document = $loader->load('https://example.com/context.jsonld');

        $this->assertSame('https://schema.org/name', $document->{'@context'}->name);
    }

    public function testAHostOutsideTheAllowListIsRefused(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            $this->clientThatMustNotBeCalled(),
        );

        $this->expectException(ContextProcessingException::class);

        $loader->load('https://other.example/context.jsonld');
    }

    /**
     * A suffix match would let "evil.example" pass an allow-list containing
     * "example", which is exactly the kind of hole this asserts against.
     */
    public function testHostMatchingIsExact(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('schema.org'),
            $this->clientThatMustNotBeCalled(),
        );

        $this->expectException(ContextProcessingException::class);

        $loader->load('https://evil.schema.org.example/context.jsonld');
    }

    /**
     * These are the URLs that used to reach is_file() and file_get_contents(),
     * turning any audited document into an arbitrary file read.
     */
    #[DataProvider('provideNonHttpUrls')]
    public function testNonHttpUrlsAreRefused(string $url): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            $this->clientThatMustNotBeCalled(),
        );

        $this->expectException(ContextProcessingException::class);
        $this->expectExceptionMessage('loading remote context failed');

        $loader->load($url);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideNonHttpUrls(): iterable
    {
        yield 'local file path' => ['/var/www/.env'];
        yield 'file wrapper' => ['file:///etc/passwd'];
        yield 'phar wrapper' => ['phar:///tmp/payload.phar/context.jsonld'];
        yield 'ftp wrapper' => ['ftp://example.com/context.jsonld'];
        yield 'data uri' => ['data:application/ld+json,{}'];
        yield 'non dereferencable iri' => ['tag:non-dereferencable-iri'];
    }

    public function testPlainHttpIsRefusedUnlessExplicitlyAllowed(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            $this->clientThatMustNotBeCalled(),
        );

        $this->expectException(ContextProcessingException::class);

        $loader->load('http://example.com/context.jsonld');
    }

    /**
     * The whole point of the opaque message: the body of a remote response must
     * never travel back to whoever supplied the document that named the URL.
     */
    public function testAnErrorResponseNeverLeaksItsBody(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            new MockHttpClient(new MockResponse('SECRET-DATABASE-PASSWORD', ['http_code' => 404])),
        );

        try {
            $loader->load('https://example.com/internal-service');
            $this->fail('The loader should have refused the response.');
        } catch (ContextProcessingException $exception) {
            $this->assertSame('loading remote context failed', $exception->getMessage());
            $this->assertStringNotContainsString('SECRET', $exception->getMessage());
            $this->assertStringNotContainsString('404', $exception->getMessage());
            $this->assertStringNotContainsString('example.com', $exception->getMessage());
        }
    }

    public function testAnOversizedResponseIsRefused(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com')->withMaxResponseBytes(1024),
            new MockHttpClient(new MockResponse(str_repeat('a', 4096))),
        );

        $this->expectException(ContextProcessingException::class);

        $loader->load('https://example.com/huge.jsonld');
    }

    /**
     * An allow-list checked only on the requested URL is escaped by a single 302,
     * so the effective URL is re-checked once redirects have been followed.
     */
    public function testARedirectOutOfTheAllowListIsRefused(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            new MockHttpClient(new MockResponse('{"@context":{}}', [
                'url' => 'https://evil.example/context.jsonld',
            ])),
        );

        $this->expectException(ContextProcessingException::class);

        $loader->load('https://example.com/context.jsonld');
    }

    /**
     * A redirect to a host outside the allow-list must be refused at the hop, not
     * only once the whole chain has been followed.
     */
    public function testARedirectToADisallowedHostIsRefusedAtTheHop(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            new MockHttpClient([
                new MockResponse('', ['http_code' => 302, 'response_headers' => ['Location' => 'https://evil.example/context.jsonld']]),
                new MockResponse('{"@context":{}}'),
            ]),
        );

        $this->expectException(ContextProcessingException::class);

        $loader->load('https://example.com/context.jsonld');
    }

    /**
     * A redirect that stays inside the allow-list is followed normally.
     */
    public function testARedirectInsideTheAllowListIsFollowed(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            new MockHttpClient([
                new MockResponse('', ['http_code' => 302, 'response_headers' => ['Location' => 'https://example.com/real.jsonld']]),
                new MockResponse('{"@context":{"name":"https://schema.org/name"}}'),
            ]),
        );

        $document = $loader->load('https://example.com/context.jsonld');

        $this->assertSame('https://schema.org/name', $document->{'@context'}->name);
    }

    #[DataProvider('provideUrlsRefusedByPolicyRefinements')]
    public function testUrlsWithUserinfoOrNonDefaultPortsAreRefused(string $url): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            $this->clientThatMustNotBeCalled(),
        );

        $this->expectException(ContextProcessingException::class);

        $loader->load($url);
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function provideUrlsRefusedByPolicyRefinements(): iterable
    {
        yield 'userinfo' => ['https://user:pass@example.com/context.jsonld'];
        yield 'non-default port' => ['https://example.com:8080/context.jsonld'];
        yield 'ssh port' => ['https://example.com:22/context.jsonld'];
    }

    public function testATransportFailureIsReportedOpaquely(): void
    {
        $loader = new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('example.com'),
            new MockHttpClient(static function (): never {
                throw new \Symfony\Component\HttpClient\Exception\TransportException('Name or service not known for example.com');
            }),
        );

        try {
            $loader->load('https://example.com/context.jsonld');
            $this->fail('The loader should have refused the response.');
        } catch (ContextProcessingException $exception) {
            $this->assertSame('loading remote context failed', $exception->getMessage());
        }
    }

    public function testTheCacheNamespaceDependsOnThePolicy(): void
    {
        $restrictive = new HttpDocumentLoader();
        $permissive = new HttpDocumentLoader(RemoteContextPolicy::allowHosts('example.com'));
        $sameAsPermissive = new HttpDocumentLoader(RemoteContextPolicy::allowHosts('example.com'));

        $this->assertNotSame($restrictive->getCacheNamespace(), $permissive->getCacheNamespace());
        $this->assertSame($permissive->getCacheNamespace(), $sameAsPermissive->getCacheNamespace());
    }

    private function clientThatMustNotBeCalled(): MockHttpClient
    {
        return new MockHttpClient(function (): never {
            $this->fail('No outbound request should have been issued.');
        });
    }
}
