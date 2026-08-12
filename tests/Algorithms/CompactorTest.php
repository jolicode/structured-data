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
use JoliCode\StructuredData\JsonLd\Algorithms\Compact\Compactor;
use JoliCode\StructuredData\JsonLd\Algorithms\ContextProcessing\Context;
use JoliCode\StructuredData\JsonLd\Algorithms\Exception\JsonLdException;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

/**
 *  @see https://w3c.github.io/json-ld-api/tests/compact-manifest.html
 * */
#[Group('compact')]
class CompactorTest extends AbstractJsonLdTestCase
{
    #[DataProvider('provideInputsAndOutputs')]
    public function testCompact(string $json, string|JsonLdException $expected, string $filename): void
    {
        $compactor = new Compactor(documentLoader: static::createDocumentLoader());
        $options = static::getOptions($filename);
        $context = self::getContextFor($filename);

        if ($expected instanceof JsonLdException) {
            try {
                $compactor->compact($json, $context, $options);

                throw new AssertionFailedError(\sprintf('An exception was expected for this test but none were thrown. Expected error message was : %s', $expected->getMessage()));
            } catch (JsonLdException $exception) {
                $this->assertSame($expected->getMessage(), $exception->getMessage());
            }
        } else {
            $compacted = $compactor->compact($json, $context, $options);

            if (!\is_string($compacted)) {
                throw new AssertionFailedError('The compacted JSON is not a string');
            }

            $this->assertEquals(json_decode($expected), json_decode($compacted));
        }
    }

    protected static function getAlgorithmName(): string
    {
        return Algorithms::COMPACT->value;
    }

    protected static function getExpectedErrorMessage(string $filename): string
    {
        $failedTestsErrorMessages = [
            'e002-in.jsonld' => 'IRI confused with prefix',
            'en01-in.jsonld' => 'invalid @nest value',
            'ep05-in.jsonld' => 'processing mode conflict',
            'ep06-in.jsonld' => 'invalid @version value',
            'ep07-in.jsonld' => 'invalid term definition',
            'ep08-in.jsonld' => 'invalid @prefix value',
            'ep09-in.jsonld' => 'invalid term definition',
            'ep10-in.jsonld' => 'invalid term definition',
            'ep11-in.jsonld' => 'invalid term definition',
            'ep12-in.jsonld' => 'invalid container mapping',
            'ep13-in.jsonld' => 'invalid container mapping',
            'ep14-in.jsonld' => 'invalid container mapping',
            'ep15-in.jsonld' => 'invalid container mapping',
            'pr01-in.jsonld' => 'invalid context nullification',
            'pr02-in.jsonld' => 'protected term redefinition',
            'pr03-in.jsonld' => 'protected term redefinition',
        ];

        $defaultErrorMessage = <<<'ERROR'
        Something went wrong with this test : it does not have an output file, which implies it expects an error to be thrown.
        However, there is no expected error message in the tests. Maybe the output file was deleted, or the Compactor is actually broken.
        ERROR;

        return $failedTestsErrorMessages[$filename] ?? $defaultErrorMessage;
    }

    protected static function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            // These tests are declared with "specVersion": "json-ld-1.0" in the W3C
            // manifest: they only apply to JSON-LD 1.0 processors. In particular,
            // e001 expects a "compaction to list of lists" error which is valid
            // JSON-LD in 1.1 processing mode.
            '0038-in.jsonld',
            'e001-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }

    protected static function getOptions(string $filename): ProcessorOptions
    {
        $options = new ProcessorOptions(base: static::getBaseUrlForW3CTests($filename));

        $processingMode10Tests = [
            '0075-in.jsonld', '0106-in.jsonld', 'ep05-in.jsonld', 'ep07-in.jsonld',
            'ep10-in.jsonld', 'ep11-in.jsonld', 'ep12-in.jsonld', 'ep13-in.jsonld',
            'ep14-in.jsonld', 'ep15-in.jsonld', 'p001-in.jsonld',
        ];

        if (\in_array($filename, $processingMode10Tests, true)) {
            $options->processingMode = Context::PROCESSING_MODE_10;
        }

        if (\in_array($filename, ['0070-in.jsonld', '0091-in.jsonld', '0093-in.jsonld'], true)) {
            $options->compactArrays = false;
        }

        if (\in_array($filename, ['0075-in.jsonld', 'r001-in.jsonld'], true)) {
            $options->base = 'http://example.org/';
        }

        if ('0114-in.jsonld' === $filename) {
            $options->base = 'https://example.org/';
        }

        if ('r002-in.jsonld' === $filename) {
            $options->compactToRelative = false;
        }

        return $options;
    }

    private static function getContextFor(string $filename): string
    {
        $contextFileName = \sprintf(
            '%s/%s/context/%s',
            self::DATA_PATH,
            static::getAlgorithmName(),
            str_replace('-in', '-context', $filename),
        );

        if (!is_file($contextFileName)) {
            throw new AssertionFailedError(\sprintf('The context file "%s" does not exist.', $contextFileName));
        }

        return (string) file_get_contents($contextFileName);
    }
}
