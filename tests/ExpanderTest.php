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
    public function testExpand(string $json, string $expected): void
    {
        $expander = new Expander();
        $options = new ProcessorOptions($this->getBaseUrlForW3CTests());
        $actual = $expander->fromJsonLd(json_decode($json), $options);

        dump('failed :(', json_decode($expected), json_decode($actual));
        $this->assertEquals(json_decode($expected), json_decode($actual));
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_EXPAND;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            // All these tests use an external context, located in a separate file that needs to be imported.
            // We don't handle these cases yet
            'so05-in.jsonld',
            'so06-in.jsonld',
            'so11-in.jsonld',
            '0126-in.jsonld',
            '0127-in.jsonld',
            '0128-in.jsonld',
            'c031-in.jsonld',
            'c034-in.jsonld',
            'so08-in.jsonld',
            'so09-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }
}
