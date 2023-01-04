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

use Jolicode\JsonLd\Fixtures\FixturesManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

abstract class AbstractJsonLdTest extends TestCase
{
    private const FIXTURES_PATH = __DIR__.'/fixtures';
    private const VAR_DIR = self::FIXTURES_PATH.'/var';

    /**
     * This function must return the name of the algorithm the child class is testing.
     */
    abstract protected function getAlgorithmName(): string;

    /**
     * There are a lot of tests available in the W3C test suite and some have a behaviour that (curently) break the tests.
     * Some input files, for example, are split in two and only have one output counterpart.
     * For now we skip them but this is a TODO : we should take care of them.
     */
    abstract protected function shouldSkipThisTest(string $filename): bool;

    protected function getInputFiles(): iterable
    {
        $this->installTestSuite();

        $finder = new Finder();

        return $finder
            ->files()
            ->in(sprintf(
                '%s/%s/input',
                self::FIXTURES_PATH,
                $this->getAlgorithmName()
            ));
    }

    protected function provideInputsAndOutputs(): iterable
    {
        foreach ($this->getInputFiles() as $inputFileName => $inputFile) {
            if ($this->shouldSkipThisTest($inputFile->getFilename())) {
                continue;
            }

            $outputFileName = $this->getOutputFileName(
                preg_replace('/-in/', '-out', $inputFile->getFilename()),
            );

            if (!is_file($outputFileName)) {
                // TODO : log a warning/an error instead
                dump(sprintf(
                    'A file could not be found. Input filename is %s, output filename is %s',
                    $inputFileName,
                    $outputFileName,
                ));

                continue;
            }

            yield $inputFile->getFilename() => [
                'json' => $inputFile->getContents(),
                'expected' => file_get_contents($outputFileName),
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
