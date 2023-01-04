<?php

namespace Tests;

use Jolicode\JsonLd\Fixtures\FixturesManager;
use Jolicode\JsonLd\Expand\Expander;

class ExpanderTest extends AbstractJsonLdTest
{
    /** @dataProvider provideInputsAndOutputs */
    public function testExpand(string $jsonToExpand, string $expected): void
    {
        $expander = new Expander();
        $actual = $expander->expand(json_decode($jsonToExpand));

        $this->assertSame($expected, $actual);
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_EXPAND;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [];

        return in_array($filename, $testsToSkip);
    }
}
