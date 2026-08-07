<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Algorithms;

use Jolicode\JsonLd\Algorithms\ContextProcessing\Context;
use Jolicode\JsonLd\Algorithms\ContextProcessing\ContextCache;
use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Http\HttpDocumentLoader;
use Jolicode\JsonLd\Algorithms\Http\RemoteContextPolicy;
use Jolicode\JsonLd\Audit\AuditOptions;
use Jolicode\JsonLd\Validator;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpClient\MockHttpClient;
use Symfony\Component\HttpClient\Response\MockResponse;

/**
 * The "@context" URLs of a document are attacker controlled whenever that document
 * is. These tests pin down what happens out of the box.
 */
#[Group('security')]
class RemoteContextPolicyIntegrationTest extends TestCase
{
    private const DOCUMENT_WITH_REMOTE_CONTEXT = <<<'JSON'
        {
            "@context": "https://evil.example/context.jsonld",
            "@type": "Person",
            "name": "Jane Doe"
        }
        JSON;

    private const DOCUMENT_WITH_SCHEMA_ORG = <<<'JSON'
        {
            "@context": "https://schema.org",
            "@type": "Person",
            "name": "Jane Doe"
        }
        JSON;

    public function testAuditIssuesNoRequestForAnArbitraryRemoteContext(): void
    {
        $validator = new Validator(documentLoader: $this->loaderThatMustNotBeCalled());

        $audit = $validator->audit(self::DOCUMENT_WITH_REMOTE_CONTEXT);

        /** @var array<string> $messages */
        $messages = $audit->getDiagnostic(new AuditOptions());

        $this->assertSame([], $audit->getTypes());
        $this->assertStringContainsString('loading remote context failed', implode("\n", $messages));
    }

    public function testAuditIssuesNoRequestForSchemaOrgEither(): void
    {
        $validator = new Validator(documentLoader: $this->loaderThatMustNotBeCalled());

        $audit = $validator->audit(self::DOCUMENT_WITH_SCHEMA_ORG);

        $this->assertSame([], $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_DOCUMENT,
        )));
        $this->assertNotSame([], $audit->getTypes());
    }

    public function testExpandRefusesAnArbitraryRemoteContextByDefault(): void
    {
        $expander = new Expander(documentLoader: $this->loaderThatMustNotBeCalled());

        $this->expectException(JsonLdException::class);
        $this->expectExceptionMessage('loading remote context failed');

        $expander->expand(self::DOCUMENT_WITH_REMOTE_CONTEXT);
    }

    public function testExpandAcceptsARemoteContextOnceItsHostIsAllowed(): void
    {
        $expander = new Expander(documentLoader: new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('evil.example'),
            new MockHttpClient(new MockResponse('{"@context":{"name":"https://schema.org/name"}}')),
        ));

        $expanded = $expander->expand(self::DOCUMENT_WITH_REMOTE_CONTEXT);

        $this->assertIsString($expanded);

        $decoded = json_decode($expanded, true);

        $this->assertIsArray($decoded);
        $this->assertIsArray($decoded[0]);
        $this->assertArrayHasKey('https://schema.org/name', $decoded[0]);
    }

    /**
     * The processed context cache is process-wide: a context resolved under a
     * permissive loader must never be handed to a restrictive one.
     */
    public function testTheProcessedContextCacheIsNotSharedAcrossPolicies(): void
    {
        $url = 'https://cache-partitioning.example/context.jsonld';
        $context = static fn (): Context => new Context(
            baseIri: 'https://cache-partitioning.example/',
            baseUrl: 'https://cache-partitioning.example/',
            processingMode: Context::PROCESSING_MODE_11,
        );

        $permissive = new ContextCache(new HttpDocumentLoader(
            RemoteContextPolicy::allowHosts('cache-partitioning.example'),
            new MockHttpClient(new MockResponse('{"@context":{"name":"https://schema.org/name"}}')),
        ));

        $remoteContexts = [$url];
        $permissive->storeProcessedRemoteContext($context(), $url, true, $remoteContexts, $context());

        $restrictive = new ContextCache();
        $remoteContexts = [$url];

        $this->assertNull($restrictive->getProcessedRemoteContext($context(), $url, true, $remoteContexts));
    }

    private function loaderThatMustNotBeCalled(): HttpDocumentLoader
    {
        return new HttpDocumentLoader(httpClient: new MockHttpClient(function (): never {
            $this->fail('No outbound request should have been issued.');
        }));
    }
}
