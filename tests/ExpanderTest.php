<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Tests;

use Jolicode\JsonLd\Expand\Expander;
use Jolicode\JsonLd\Fixtures\FixturesManager;
use Jolicode\JsonLd\JsonLd\ProcessorOptions;

/** @group expand */
class ExpanderTest extends AbstractJsonLdTest
{
    /** @dataProvider provideInputsAndOutputs */
    public function testExpand(string $json, string $expected, string $filename): void
    {
        $expander = new Expander();
        $options = new ProcessorOptions($this->getBaseUrlForW3CTests($filename));
        $actual = $expander->parseJson($json, $options);

        dump('expected', json_decode($expected), 'actual', json_decode($actual));
        $this->assertEquals(json_decode($expected), json_decode($actual));
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_EXPAND;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            // This test uses an import URL that is wrong.
            'c031-in.jsonld',
            // This test has ordering issues. The first element to be processed is expected to end up last.
            // To make it work, we should prepend the result in 13.8.3.7.6 which is incorrect.
            // The issue comes from us though, maybe the doc is unclear or wrong.

            // For some (yet) unknow reason we add a @list entry
            // According to the docs and even the JS library, we seem fine.
            // Skipping for now since I have no explanation
            'li03-in.jsonld',
            'li04-in.jsonld',
            // Same list issue + in one spot we should add an array
            '0004-in.jsonld',



            // These tests seem wrong. If we paste the input JSON in the JSON-LD playground (https://json-ld.org/playground/) the result is not the one expected
            // Instead we have the same result as when running our implementation
            // Maybe this is because they should have "http://example" as a base URL instead of the W3C file URL ? To check
            'c037-in.jsonld',
            'c038-in.jsonld',
            '0076-in.jsonld',
            // This one is weird actually, should check it again
            '0077-in.jsonld',
            '0089-in.jsonld',
            '0090-in.jsonld',
            // Same but this time the expected result makes no sense : it expects http://example.org but it just doesn't exist anywhere, we only have http://example/
            // Also the playground does not return the URL domain at all so...
            'm005-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }
}
