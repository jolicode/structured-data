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
        $options = new ProcessorOptions($this->getBaseURL($filename));
        $actual = $expander->parseJson($json, $options);

        $this->assertEquals(json_decode($expected), json_decode($actual));
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_EXPAND;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            // This test uses an import URL that is broken with the League\Uri library. It is supposed to work however.
            'c031-in.jsonld',

            // These tests seem wrong. If we paste the input JSON in the JSON-LD playground (https://json-ld.org/playground/) the result is not the one expected
            // Instead we have the same result as when running our implementation and changing the options doesn't change anything
            'c038-in.jsonld',
            '0077-in.jsonld',
            'c037-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }

    private function getBaseURL(string $filename): string
    {
        $specialUrls = [
            '0076-in.jsonld' => 'http://example/base/',
            '0089-in.jsonld' => 'http://example/base/',
            '0090-in.jsonld' => 'http://example/base/',
            'm005-in.jsonld' => 'http://example.org/',
        ];

        return $specialUrls[$filename] ?? $this->getBaseUrlForW3CTests($filename);
    }
}
