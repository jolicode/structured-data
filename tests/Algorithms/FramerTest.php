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
use JoliCode\StructuredData\JsonLd\Algorithms\Frame\Framer;
use JoliCode\StructuredData\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use PHPUnit\Framework\AssertionFailedError;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

/**
 *  @see https://w3c.github.io/json-ld-framing/tests/frame-manifest.html
 * */
#[Group('frame')]
class FramerTest extends AbstractJsonLdTestCase
{
    public const FRAMING_DATA_PATH = __DIR__ . '/../../var/cache/w3c-json-ld-framing/tests';

    #[DataProvider('provideInputsAndOutputs')]
    public function testFrame(string $json, string|JsonLdException $expected, string $filename): void
    {
        $framer = new Framer(documentLoader: static::createDocumentLoader());
        $options = static::getOptions($filename);
        $frame = self::getFrameFor($filename);

        if ($expected instanceof JsonLdException) {
            try {
                $framer->frame($json, $frame, $options);

                throw new AssertionFailedError(\sprintf('An exception was expected for this test but none were thrown. Expected error message was : %s', $expected->getMessage()));
            } catch (JsonLdException $exception) {
                $this->assertSame($expected->getMessage(), $exception->getMessage());
            }
        } else {
            $framed = $framer->frame($json, $frame, $options);

            if (!\is_string($framed)) {
                throw new AssertionFailedError('The framed JSON is not a string');
            }

            $this->assertEquals(json_decode($expected), json_decode($framed));
        }
    }

    protected static function getDataPath(): string
    {
        return self::FRAMING_DATA_PATH;
    }

    protected static function getAlgorithmName(): string
    {
        return Algorithms::FRAME->value;
    }

    protected static function getExpectedErrorMessage(string $filename): string
    {
        $failedTestsErrorMessages = [
            '0052-in.jsonld' => 'invalid frame',
            '0053-in.jsonld' => 'invalid frame',
            '0054-in.jsonld' => 'invalid @embed value',
        ];

        $defaultErrorMessage = <<<'ERROR'
        Something went wrong with this test : it does not have an output file, which implies it expects an error to be thrown.
        However, there is no expected error message in the tests. Maybe the output file was deleted, or the Framer is actually broken.
        ERROR;

        return $failedTestsErrorMessages[$filename] ?? $defaultErrorMessage;
    }

    protected static function shouldSkipThisTest(string $filename): bool
    {
        $testsToSkip = [
            // This test is declared with "specVersion": "json-ld-1.0" in the W3C
            // manifest: it only applies to JSON-LD 1.0 processors.
            '0010-in.jsonld',
            // This file exists in the W3C repository but has no entry in the
            // frame-manifest (its frame document is not even valid JSON).
            'eo02-in.jsonld',
        ];

        return \in_array($filename, $testsToSkip, true);
    }

    protected static function getOptions(string $filename): ProcessorOptions
    {
        $options = new ProcessorOptions(base: \sprintf(
            'https://w3c.github.io/json-ld-framing/tests/frame/%s',
            $filename,
        ));

        $processingMode10Tests = [
            '0001-in.jsonld', '0002-in.jsonld', '0003-in.jsonld', '0004-in.jsonld',
            '0005-in.jsonld', '0006-in.jsonld', '0007-in.jsonld', '0008-in.jsonld',
            '0009-in.jsonld', '0016-in.jsonld', '0017-in.jsonld', '0018-in.jsonld',
            '0020-in.jsonld', '0021-in.jsonld', '0022-in.jsonld', '0046-in.jsonld',
            '0049-in.jsonld', '0059-in.jsonld',
        ];

        if (\in_array($filename, $processingMode10Tests, true)) {
            $options->processingMode = Context::PROCESSING_MODE_10;
        }

        if ('0058-in.jsonld' === $filename) {
            $options->omitGraph = false;
        }

        if ('0060-in.jsonld' === $filename) {
            $options->ordered = true;
        }

        if ('g001-in.jsonld' === $filename) {
            $options->omitGraph = true;
        }

        return $options;
    }

    private static function getFrameFor(string $filename): string
    {
        $frameFileName = \sprintf(
            '%s/%s/frame/%s',
            static::getDataPath(),
            static::getAlgorithmName(),
            str_replace('-in', '-frame', $filename),
        );

        if (!is_file($frameFileName)) {
            throw new AssertionFailedError(\sprintf('The frame file "%s" does not exist.', $frameFileName));
        }

        return (string) file_get_contents($frameFileName);
    }
}
