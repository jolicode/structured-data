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

use JoliCode\StructuredData\JsonLd\Algorithms\Http\RemoteContextPolicy;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('security')]
class RemoteContextPolicyTest extends TestCase
{
    public function testTheDefaultPolicyAllowsNothing(): void
    {
        $policy = RemoteContextPolicy::schemaOrgOnly();

        $this->assertSame([], $policy->allowedHosts);
        $this->assertFalse($policy->allows('https://schema.org/'));
        $this->assertFalse($policy->allows('https://example.com/context.jsonld'));
    }

    public function testHostsAreMatchedCaseInsensitively(): void
    {
        $policy = RemoteContextPolicy::allowHosts('Example.COM');

        $this->assertTrue($policy->allows('https://example.com/context.jsonld'));
        $this->assertTrue($policy->allows('https://EXAMPLE.com/context.jsonld'));
    }

    public function testMalformedUrlsAreRefused(): void
    {
        $policy = RemoteContextPolicy::allowHosts('example.com');

        $this->assertFalse($policy->allows(''));
        $this->assertFalse($policy->allows('not a url'));
        $this->assertFalse($policy->allows('/relative/path.jsonld'));
    }

    public function testOnlyHttpSchemesMayBeAllowed(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        RemoteContextPolicy::allowHosts('example.com')->withSchemes('file');
    }

    /**
     * The fingerprint namespaces a process-wide cache, so two policies that allow
     * the same thing must agree whatever the order they were declared in.
     */
    public function testTheFingerprintIsOrderIndependent(): void
    {
        $first = RemoteContextPolicy::allowHosts('a.example', 'b.example');
        $second = RemoteContextPolicy::allowHosts('b.example', 'a.example');

        $this->assertSame($first->fingerprint(), $second->fingerprint());
    }

    public function testTheFingerprintChangesWithEveryLimit(): void
    {
        $policy = RemoteContextPolicy::allowHosts('example.com');

        $this->assertNotSame($policy->fingerprint(), RemoteContextPolicy::schemaOrgOnly()->fingerprint());
        $this->assertNotSame($policy->fingerprint(), $policy->withHosts('other.example')->fingerprint());
        $this->assertNotSame($policy->fingerprint(), $policy->withSchemes('http', 'https')->fingerprint());
        $this->assertNotSame($policy->fingerprint(), $policy->withTimeouts(1.0, 2.0)->fingerprint());
        $this->assertNotSame($policy->fingerprint(), $policy->withMaxRedirects(1)->fingerprint());
        $this->assertNotSame($policy->fingerprint(), $policy->withMaxResponseBytes(1)->fingerprint());
        $this->assertNotSame($policy->fingerprint(), $policy->withMaxHops(1)->fingerprint());
    }
}
