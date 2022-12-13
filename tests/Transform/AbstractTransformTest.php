<?php

namespace Tests\Transform;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;

abstract class AbstractTransformTest extends TestCase
{
    protected const ALGO_FLATTEN = 'flatten';
    protected const ALGO_COMPACT = 'compact';
    protected const ALGO_EXPAND = 'expand';

    protected const ALGORITHMS = [
        self::ALGO_FLATTEN => self::ALGO_FLATTEN,
        self::ALGO_COMPACT => self::ALGO_COMPACT,
        self::ALGO_EXPAND => self::ALGO_EXPAND,
    ];

    private const FIXTURES_PATH = __DIR__ . '/../fixtures';
    private const TMP_DIR = self::FIXTURES_PATH . '/tmp';
    private const W3C_ARCHIVE = self::TMP_DIR . '/w3c-tests.zip';

    protected function setUp(): void
    {
        $this->installTestFixtures();
    }

    /**
     * This function must return the name of the algorithm the child class is testing.
     */
    abstract protected function getAlgorithmName(): string;

    protected function getInputFiles(): iterable
    {
        $finder = new Finder();

        return $finder->files()->in(sprintf(
            '/%s/%s/input',
            self::FIXTURES_PATH,
            $this->getAlgorithmName()
        ));
    }

    protected function getOutputFile(string $filename): string
    {
        return sprintf(
            '%s/%s/output/%s',
            self::FIXTURES_PATH,
            $this->getAlgorithmName(),
            $filename,
        );
    }

    private function installTestFixtures(): void
    {
        if (is_dir(self::TMP_DIR)) {
            // We only need to download the tests once ;D
            return;
        }

        $this->downloadW3CArchive();
        $this->assignTestFiles();
    }

    private function downloadW3CArchive(): void
    {
        mkdir(self::TMP_DIR);

        file_put_contents(
            self::W3C_ARCHIVE,
            file_get_contents('https://github.com/w3c/json-ld-api/archive/main.zip')
        );

        $zip = new \ZipArchive();
        $zip->open(self::W3C_ARCHIVE);
        $zip->extractTo(self::TMP_DIR);
        $zip->close();
    }

    private function assignTestFiles(): void
    {
        foreach (self::ALGORITHMS as $algorithm) {
            // First we copy all the input files to the input directory
            $this->copyW3CFiles($algorithm, '/-in.jsonld/', 'input');
            // Then the output files to the output directory ^___^
            $this->copyW3CFiles($algorithm, '/-out.jsonld/', 'output');
        }
    }

    private function copyW3CFiles(string $algorithm, string $regex, string $directory): void
    {
        $filesystem = new Filesystem();
        $finder = new Finder();

        $inputFiles = $finder
            ->in(sprintf('%s/json-ld-api-main/tests/%s', self::TMP_DIR, $algorithm))
            ->files()
            ->filter(
                fn (\SplFileInfo $file) => preg_match($regex, $file->getFilename()) ? $file : false
            );

        foreach ($inputFiles as $inputFile) {
            $filesystem->copy(
                $inputFile->getPathname(),
                sprintf(
                    '%s/%s/%s/%s',
                    self::FIXTURES_PATH,
                    $this->getAlgorithmName(),
                    $directory,
                    $inputFile->getFilename()
                )
            );
        }
    }
}
