<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Algorithms;

use JoliCode\StructuredData\JsonLd\Algorithms;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\Flatten\Flattener;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

/**
 * @see https://w3c.github.io/json-ld-api/tests/flatten-manifest.html
 * */
#[Group('flatten')]
class FlattenerTest extends AbstractJsonLdTestCase
{
    #[DataProvider('provideInputsAndOutputs')]
    public function testFlatten(string $json, string|JsonLdException $expected, string $filename): void
    {
        $flattener = new Flattener(documentLoader: static::createDocumentLoader());
        $options = static::getOptions($filename);
        $context = self::getContextFor($filename);

        if ($expected instanceof JsonLdException) {
            try {
                $flattener->flatten($json, $context, $options);

                throw new AssertionFailedError(\sprintf('An exception was expected for this test but none were thrown. Expected error message was : %s', $expected->getMessage()));
            } catch (JsonLdException $exception) {
                $this->assertSame($expected->getMessage(), $exception->getMessage());
            }
        } else {
            $flattened = $flattener->flatten($json, $context, options: $options);

            if (!\is_string($flattened)) {
                throw new AssertionFailedError('The expanded JSON is not a string');
            }

            $this->assertEquals(json_decode($expected), json_decode($flattened));
        }
    }

    protected static function getAlgorithmName(): string
    {
        return Algorithms::FLATTEN->value;
    }

    protected static function getExpectedErrorMessage(string $filename): string
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

    protected static function shouldSkipThisTest(string $filename): bool
    {
        return false;
    }

    protected static function getOptions(string $filename): ProcessorOptions
    {
        $options = new ProcessorOptions(base: static::getBaseUrlForW3CTests($filename));

        if ('0014-in.jsonld' === $filename || '0026-in.jsonld' === $filename) {
            $options->processingMode = Context::PROCESSING_MODE_10;
        }

        if ('0044-in.jsonld' === $filename) {
            $options->compactArrays = false;
        }

        return $options;
    }

    /**
     * Most flatten tests have no context; the few that do exercise the context-based
     * compaction step of the flatten() API (step 6.1).
     */
    private static function getContextFor(string $filename): ?string
    {
        $contextFileName = \sprintf(
            '%s/%s/context/%s',
            self::DATA_PATH,
            static::getAlgorithmName(),
            str_replace('-in', '-context', $filename),
        );

        if (!is_file($contextFileName)) {
            return null;
        }

        return (string) file_get_contents($contextFileName);
    }
}
