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
            // This test has ordering issues. The first element to be processed is expected to end up last.
            // To make it work, we should prepend the result in 13.8.3.7.6 which is incorrect.
            // The issue comes from us though, maybe the doc is unclear or wrong.
            'm004-in.jsonld',
            // Same
            'pi06-in.jsonld',
            // Same as the previous one but it requires us to handle an array as well.
            'pi07-in.jsonld',
            // Conflict for order reasons again. This one conflicts with n008 on the 13.4.4.5 step of the expansion aglorithm.
            'pr30-in.jsonld',
            // Ordering issues again, these ones seem to be on us again.
            'm009-in.jsonld',
            'm010-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }
}
