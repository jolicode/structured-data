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
use Jolicode\JsonLd\Algorithms\JsonLd\ProcessorOptions;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

abstract class AbstractJsonLdTestCase extends TestCase
{
    public const DATA_PATH = __DIR__ . '/../../var/cache/w3c-json-ld-api/tests';

    public static function provideInputsAndOutputs(): iterable
    {
        foreach (static::getInputFiles() as $inputFile) {
            $filename = $inputFile->getFilename();

            if (static::shouldSkipThisTest($filename)) {
                continue;
            }

            $outputFileName = static::getOutputFileName(
                str_replace('-in', '-out', $filename),
            );

            if (is_file($outputFileName)) {
                $expected = file_get_contents($outputFileName);
            } else {
                $expected = new JsonLdException(static::getExpectedErrorMessage($filename));
            }

            yield $filename => [
                'json' => $inputFile->getContents(),
                'expected' => $expected,
                'filename' => $filename,
            ];
        }
    }

    protected static function getDataPath(): string
    {
        return self::DATA_PATH;
    }

    /**
     * This function must return the name of the algorithm the child class is testing.
     */
    abstract protected static function getAlgorithmName(): string;

    /**
     * There are a lot of tests available in the W3C test suite and some just seem wrong.
     * To prevent them from breaking the tests, we just skip them.
     *
     * This method is also helpful for developping and debugging purposes : sometimes you know a test is broken,
     * but you don't want to fix it yet because you are working on another one.
     */
    abstract protected static function shouldSkipThisTest(string $filename): bool;

    /**
     * Some tests are expected to fail and to throw an error.
     * This method must return the error message associated with the given filename.
     * A default error message saying that something went wrong should be added as well.
     */
    abstract protected static function getExpectedErrorMessage(string $filename): string;

    /**
     * Some tests require some special options to work.
     * This method must return the corresponding options for this test, available at https://w3c.github.io/json-ld-api/tests.
     */
    abstract protected static function getOptions(string $filename): ProcessorOptions;

    protected static function getInputFiles(): Finder
    {
        $directoryName = \sprintf('%s/%s/input/', static::getDataPath(), static::getAlgorithmName());

        if (!file_exists($directoryName)) {
            throw new \RuntimeException(\sprintf('The input directory "%s" does not exist. Did you forget to install the test suite? Please run the following command : `castor qa:phpunit:install-fixtures`', $directoryName));
        }

        return (new Finder())
            ->files()
            ->in($directoryName)
        ;
    }

    protected static function getBaseUrlForW3CTests(string $filename): string
    {
        return \sprintf(
            'https://w3c.github.io/json-ld-api/tests/%s/%s',
            static::getAlgorithmName(),
            $filename,
        );
    }

    protected static function getOutputFileName(string $filename): string
    {
        return \sprintf(
            '%s/%s/output/%s',
            static::getDataPath(),
            static::getAlgorithmName(),
            $filename,
        );
    }
}
