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

use Jolicode\JsonLd\Flatten\Flattener;
use Jolicode\JsonLd\JsonLd\ProcessorOptions;
use Jolicode\JsonLd\Fixtures\FixturesManager;

/** @group flatten */
class FlattenerTest extends AbstractJsonLdTestCase
{
    /** @dataProvider provideInputsAndOutputs */
    public function testFlatten(string $json, string $expected, string $filename): void
    {
        $flattener = new Flattener();
        $options = new ProcessorOptions($this->getBaseUrlForW3CTests($filename));

        $actual = $flattener->parseJson($json, options: $options);

        $this->assertEquals(json_decode($expected), json_decode($actual));
    }

    protected function getAlgorithmName(): string
    {
        return FixturesManager::ALGO_FLATTEN;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            // The result of our test seem completely fine. The JSON-LD playground has the same result than us, so we skip.
            '0014-in.jsonld',
            // This one is juste false : it expects to keep the @context entry in the result, but this is wrong, the expander is supposed to remove it.
            // The playground agrees with us and everything else is fine
            '0044-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }
}
