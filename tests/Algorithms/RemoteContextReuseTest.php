<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms;

use JoliCode\StructuredData\JsonLd\Algorithms\Exception\TermDefinitionCreationException;
use JoliCode\StructuredData\JsonLd\Algorithms\Expand\Expander;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

/**
 * A remote context processed on top of an already populated active context is
 * applied from the static schema.org data instead of being rebuilt term by term.
 * These tests pin the behaviour that optimisation must not change.
 */
#[Group('algorithms')]
class RemoteContextReuseTest extends TestCase
{
    public function testRepeatingTheRemoteContextInGraphNodesDoesNotChangeTheExpansion(): void
    {
        $expander = new Expander();

        $withRepeatedContext = <<<'JSONLD'
            {
              "@context": "https://schema.org",
              "@graph": [
                {"@context": "https://schema.org", "@type": "Person", "name": "Alice"},
                {"@context": "https://schema.org", "@type": "Organization", "name": "JoliCode"}
              ]
            }
            JSONLD;

        $withSingleContext = <<<'JSONLD'
            {
              "@context": "https://schema.org",
              "@graph": [
                {"@type": "Person", "name": "Alice"},
                {"@type": "Organization", "name": "JoliCode"}
              ]
            }
            JSONLD;

        $this->assertSame(
            $expander->expand($withSingleContext),
            $expander->expand($withRepeatedContext),
        );
    }

    public function testARemoteContextAppliedOnTopOfAnotherOneOverridesItsTerms(): void
    {
        $expander = new Expander();

        $document = <<<'JSONLD'
            {
              "@context": {"name": "http://example.org/name", "Person": "http://example.org/Person"},
              "@graph": [
                {"@context": "https://schema.org", "@type": "Person", "name": "Alice"}
              ]
            }
            JSONLD;

        $expanded = $expander->expand($document);
        $this->assertIsString($expanded);
        $this->assertSame(
            [['@type' => ['http://schema.org/Person'], 'http://schema.org/name' => [['@value' => 'Alice']]]],
            json_decode($expanded, true),
        );
    }

    public function testATermDefinedAfterTheRemoteContextStillWins(): void
    {
        $expander = new Expander();

        $document = <<<'JSONLD'
            {
              "@context": "https://schema.org",
              "@graph": [
                {
                  "@context": ["https://schema.org", {"name": "http://example.org/custom"}],
                  "@type": "Person",
                  "name": "Alice"
                }
              ]
            }
            JSONLD;

        $expanded = $expander->expand($document);
        $this->assertIsString($expanded);
        $this->assertSame(
            [['@type' => ['http://schema.org/Person'], 'http://example.org/custom' => [['@value' => 'Alice']]]],
            json_decode($expanded, true),
        );
    }

    public function testRedefiningAProtectedTermWithTheRemoteContextStillRaises(): void
    {
        $expander = new Expander();

        $document = <<<'JSONLD'
            {
              "@context": [{"@protected": true, "name": "http://example.org/name"}, "https://schema.org"],
              "@type": "Person",
              "name": "Alice"
            }
            JSONLD;

        $this->expectException(TermDefinitionCreationException::class);
        $this->expectExceptionMessage('protected term redefinition');

        $expander->expand($document);
    }
}
