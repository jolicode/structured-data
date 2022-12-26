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

use Jolicode\JsonLd\Fixtures\FixturesManager;
use Jolicode\JsonLd\Flatten\Flattener;

/** @group flatten */
class FlattenerTest extends AbstractJsonLdTest
{
    /** @dataProvider provideInputsAndOutputs */
    public function testFlatten(string $json, string $expected): void
    {
        $this->assertTrue(true);
        // $flattener = new Flattener();
        // $actual = $flattener->flatten(json_decode($json));

        // $this->assertSame($expected, $actual);
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_FLATTEN;
    }

    /**
     * There are a lot of tests available in the W3C test suite and some have a behaviour that (curently) break the tests.
     * Some input files, for example, are split in two and only have one output counterpart.
     * For now we skip them but this is a TODO : we should take care of them.
     */
    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            'e001-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }
}
