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

use Jolicode\JsonLd\Algorithms;
use Jolicode\JsonLd\Algorithms\ContextProcessing\Context;
use Jolicode\JsonLd\Algorithms\Exception\JsonLdException;
use Jolicode\JsonLd\Algorithms\Flatten\Flattener;
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use PHPUnit\Framework\AssertionFailedError;

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
                $flattener->flatten($json, $options);

                throw new AssertionFailedError(\sprintf('An exception was expected for this test but none were thrown. Expected error message was : %s', $expected->getMessage()));
            } catch (JsonLdException $exception) {
                $this->assertSame($expected->getMessage(), $exception->getMessage());
            }
        } else {
            $flattened = $flattener->flatten($json, options: $options);

            if (!\is_string($flattened)) {
                throw new AssertionFailedError('The expanded JSON is not a string');
            }

            $this->assertEquals(json_decode($expected), json_decode($flattened));
        }
    }

    protected function getAlgorithmName(): string
    {
        return Algorithms::FLATTEN->value;
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
            // Requires the context-based compaction step inside flatten(), which is not yet implemented.
            // See TODO comment in Flattener::flatten().
            '0044-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }

    protected function getOptions(string $filename): ProcessorOptions
    {
        $options = new ProcessorOptions(base: $this->getBaseUrlForW3CTests($filename));

        if ('0014-in.jsonld' === $filename || '0026-in.jsonld' === $filename) {
            $options->processingMode = Context::PROCESSING_MODE_10;
        }

        return $options;
    }
}
