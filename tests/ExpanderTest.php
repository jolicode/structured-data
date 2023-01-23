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

/** @group expand */
class ExpanderTest extends AbstractJsonLdTest
{
    /** @dataProvider provideInputsAndOutputs */
    public function testExpand(string $json, string $expected): void
    {
        $expander = new Expander();
        $actual = $expander->fromJsonLd(json_decode($json));

        $this->assertSame($expected, $actual);
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_EXPAND;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [];

        return \in_array($filename, $testsToSkip, true);
    }
}
