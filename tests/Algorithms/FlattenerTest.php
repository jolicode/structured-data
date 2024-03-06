<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Algorithms;

use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Fixtures\FixturesInstaller;
use Jolicode\JsonLd\Algorithms\Flatten\Flattener;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;

/**
 * @see https://w3c.github.io/json-ld-api/tests/flatten-manifest.html
 *
 *  @group flatten
 * */
class FlattenerTest extends AbstractJsonLdTestCase
{
    /** @dataProvider provideInputsAndOutputs */
    public function testFlatten(string $json, string|JsonLdException $expected, string $filename): void
    {
        $flattener = new Flattener();
        $options = $this->getOptions($filename);

        if ($expected instanceof JsonLdException) {
            try {
                $flattener->parseJson($json, $options);
            } catch (JsonLdException $exception) {
                $this->assertSame($expected->getMessage(), $exception->getMessage());
            }
        } else {
            $this->assertSame(json_decode($expected), json_decode($flattener->parseJson($json, options: $options)));
        }
    }

    protected function getAlgorithmName(): string
    {
        return FixturesInstaller::ALGO_FLATTEN;
    }

    protected function getExpectedErrorMessage(string $filename): string
    {
        $failedTestsErrorMessages = [
            'e001-in.jsonld' => 'Conflicting Index Exception : aborting processing',
        ];

        $defaultErrorMessage = <<<'ERROR'
        Something went wrong with this test : it does not have an output file, which implies it expects an error to be thrown.
        However, there is no expected error message in the tests. Maybe the output file was deleted, or the Flattener is actually broken.
        ERROR;

        return $failedTestsErrorMessages[$filename] ?? $defaultErrorMessage;
    }

    protected function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            // The result of our test seem completely fine. The JSON-LD playground has the same result than us, so we skip.
            '0014-in.jsonld',

            // This one is juste false : it expects to keep the @context entry in the result, but this is wrong, the expander is supposed to remove it.
            // The playground agrees with us and everything else is fine.
            '0044-in.jsonld',

            // The specVersion of these tests is 1.0, we are using 1.1. They seem to be outdated se we skip them.
            // Moreover, the playground has the same results as we do so we are pretty confident.
            '0026-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }

    protected function getOptions(string $filename): ProcessorOptions
    {
        $options = new ProcessorOptions(base: $this->getBaseUrlForW3CTests($filename));

        $testSpecificOptions = [];

        if (\array_key_exists($filename, $testSpecificOptions)) {
            foreach ($testSpecificOptions[$filename] as $property => $value) {
                $options->{$property} = $value;
            }
        }

        return $options;
    }
}
