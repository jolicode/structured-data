<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests;

use Jolicode\JsonLd\Fixtures\FixturesManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

abstract class AbstractJsonLdTestCase extends TestCase
{
    public const FIXTURES_PATH = __DIR__ . '/fixtures';
    public const VAR_DIR = self::FIXTURES_PATH . '/var';

    /**
     * This function must return the name of the algorithm the child class is testing.
     */
    abstract protected function getAlgorithmName(): string;

    /**
     * There are a lot of tests available in the W3C test suite and some just seem wrong.
     * To prevent them from breaking the tests, we just skip them.
     *
     * This method is also helpful for developping and debugging purposes : sometimes you know a test is broken,
     * but you don't want to fix it yet because you are working on another one.
     */
    abstract protected function shouldSkipThisTest(string $filename): bool;

    protected function getInputFiles(): iterable
    {
        $this->installTestSuite();

        $finder = new Finder();

        return $finder
            ->files()
            ->in(sprintf(
                '%s/%s/input/',
                self::FIXTURES_PATH,
                $this->getAlgorithmName()
            ));
    }

    protected function getBaseUrlForW3CTests(string $filename): string
    {
        return sprintf(
            'https://w3c.github.io/json-ld-api/tests/%s/%s',
            $this->getAlgorithmName(),
            $filename
        );
    }

    protected function provideInputsAndOutputs(): iterable
    {
        foreach ($this->getInputFiles() as $inputFile) {
            if ($this->shouldSkipThisTest($inputFile->getFilename())) {
                continue;
            }

            $outputFileName = $this->getOutputFileName(
                preg_replace('/-in/', '-out', $inputFile->getFilename()),
            );

            if (!is_file($outputFileName)) {
                continue;
            }

            yield $inputFile->getFilename() => [
                'json' => $inputFile->getContents(),
                'expected' => file_get_contents($outputFileName),
                'filename' => $inputFile->getFilename(),
            ];
        }
    }

    protected function getOutputFileName(string $filename): string
    {
        return sprintf(
            '%s/%s/output/%s',
            self::FIXTURES_PATH,
            $this->getAlgorithmName(),
            $filename,
        );
    }

    protected function installTestSuite(): void
    {
        if (is_dir(self::VAR_DIR)) {
            // We only need to download the tests once ;D.
            // Use the reset command if you have issues with the installed test suite.
            return;
        }

        FixturesManager::installFixtures();
    }
}
