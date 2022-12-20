<?php

namespace Tests;

use Jolicode\JsonLd\Fixtures\FixturesManager;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

abstract class AbstractJsonLdTest extends TestCase
{
    private const FIXTURES_PATH = __DIR__ . '/fixtures';
    private const VAR_DIR = self::FIXTURES_PATH . '/var';

    /**
     * This function must return the name of the algorithm the child class is testing.
     */
    abstract protected function getAlgorithmName(): string;

    protected function getInputFiles(): iterable
    {
        $finder = new Finder();

        return $finder
            ->files()
            ->in(sprintf(
                '%s/%s/input',
                self::FIXTURES_PATH,
                $this->getAlgorithmName()
            ));
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
