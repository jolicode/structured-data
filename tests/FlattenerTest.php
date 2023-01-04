<?php

namespace Tests;

use Jolicode\JsonLd\Fixtures\FixturesManager;
use Jolicode\JsonLd\Flatten\Flattener;

class FlattenerTest extends AbstractJsonLdTest
{
    /** @dataProvider provideInputsAndOutputs */
    public function testFlatten(string $jsonToFlatten, string $expected): void
    {
        $flattener = new Flattener();
        $actual = $flattener->flatten(json_decode($jsonToFlatten));

        $this->assertSame($expected, $actual);
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

        return in_array($filename, $testsToSkip);
    }
}
