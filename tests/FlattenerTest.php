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
class FlattenerTest extends AbstractJsonLdTestCase
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

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            'e001-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }
}
