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

use JoliCode\StructuredData\JsonLd\Algorithms\Http\LinkHeaderParser;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('algorithms')]
class LinkHeaderParserTest extends TestCase
{
    public function testAHeaderListingSeveralLinksIsSplit(): void
    {
        $this->assertSame(
            [
                ['uri' => 'context.jsonld', 'rel' => 'http://www.w3.org/ns/json-ld#context', 'type' => 'application/ld+json'],
                ['uri' => 'other.jsonld', 'rel' => 'alternate'],
            ],
            LinkHeaderParser::parse([
                '<context.jsonld>; rel="http://www.w3.org/ns/json-ld#context"; type="application/ld+json", <other.jsonld>; rel="alternate"',
            ]),
        );
    }

    public function testACommaInsideAQuotedParameterDoesNotSplitTheLink(): void
    {
        $this->assertSame(
            [['uri' => 'context.jsonld', 'rel' => 'alternate', 'title' => 'one, two']],
            LinkHeaderParser::parse(['<context.jsonld>; rel="alternate"; title="one, two"']),
        );
    }

    public function testAParameterValueMayBeABareToken(): void
    {
        $this->assertSame(
            [['uri' => 'document.jsonld', 'rel' => 'alternate', 'type' => 'application/ld+json']],
            LinkHeaderParser::parse(['<document.jsonld>; rel=alternate; type="application/ld+json"']),
        );
    }

    public function testAnEqualSignInsideAValueIsKept(): void
    {
        $this->assertSame(
            [['uri' => 'document.jsonld', 'title' => 'a=b', 'anchor' => 'c=d']],
            LinkHeaderParser::parse(['<document.jsonld>; title="a=b"; anchor=c=d']),
        );
    }

    public function testAValuelessParameterAndAMalformedLinkAreIgnored(): void
    {
        $this->assertSame(
            [['uri' => 'context.jsonld', 'type' => 'application/ld+json']],
            LinkHeaderParser::parse(['<context.jsonld>; rel; type="application/ld+json"', 'not a link']),
        );
    }
}
