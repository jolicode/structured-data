<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Fixtures;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class FixturesManager
{
    public const ALGO_PROCESS_CONTEXT = 'context';
    public const ALGO_FLATTEN = 'flatten';
    public const ALGO_COMPACT = 'compact';
    public const ALGO_EXPAND = 'expand';

    // This constant only include algorithms with a directory in the official test suite : https://github.com/w3c/json-ld-api/tree/main/tests
    // Other algorithms are handled in a different way.
    private const ALGORITHMS = [
        self::ALGO_FLATTEN => self::ALGO_FLATTEN,
        self::ALGO_COMPACT => self::ALGO_COMPACT,
        self::ALGO_EXPAND => self::ALGO_EXPAND,
    ];

    private const FIXTURES_PATH = __DIR__ . '/../../tests/fixtures';
    private const VAR_DIR = self::FIXTURES_PATH . '/var';
    private const W3C_ARCHIVE = self::VAR_DIR . '/w3c-tests.zip';

    public static function installFixtures(): void
    {
        // TODO:  Add a logger probably, or at least write something in the console ?
        self::downloadW3CArchive();
        self::assignTestFiles();
    }

    /**
     * @param bool $generateAnew if set to true, will reinstall the test suite
     */
    public static function resetFixtures(bool $generateAnew = false): void
    {
        // TODO:  Add a logger probably, or at least write something in the console ?
        $finder = new Finder();
        $filesystem = new Filesystem();

        foreach (self::ALGORITHMS as $algorithm) {
            $inputFiles = $finder
                ->in(sprintf('%s/%s/input', self::FIXTURES_PATH, $algorithm))
                ->files()
                ->ignoreDotFiles(true);
            $filesystem->remove($inputFiles);

            $outputFiles = $finder
                ->in(sprintf('%s/%s/output', self::FIXTURES_PATH, $algorithm))
                ->files()
                ->ignoreDotFiles(true);
            $filesystem->remove($outputFiles);
        }

        $filesystem->remove(self::VAR_DIR);

        if ($generateAnew) {
            self::installFixtures();
        }
    }

    private static function downloadW3CArchive(): void
    {
        mkdir(self::VAR_DIR);

        file_put_contents(
            self::W3C_ARCHIVE,
            file_get_contents('https://github.com/w3c/json-ld-api/archive/main.zip')
        );

        $zip = new \ZipArchive();
        $zip->open(self::W3C_ARCHIVE);
        $zip->extractTo(self::VAR_DIR);
        $zip->close();
    }

    private static function assignTestFiles(): void
    {
        foreach (self::ALGORITHMS as $algorithm) {
            // First we copy all the input files to the input directory
            self::copyW3CFiles($algorithm, '/-in.jsonld/', 'input');
            // Then the output files to the output directory ^___^
            self::copyW3CFiles($algorithm, '/-out.jsonld/', 'output');
        }
    }

    private static function copyW3CFiles(string $algorithm, string $regex, string $directory): void
    {
        $finder = new Finder();
        $filesystem = new Filesystem();

        $files = $finder
            ->in(sprintf('%s/json-ld-api-main/tests/%s', self::VAR_DIR, $algorithm))
            ->files()
            ->filter(
                fn (\SplFileInfo $file) => preg_match($regex, $file->getFilename()) ? $file : false
            );

        foreach ($files as $file) {
            $filesystem->copy(
                $file->getPathname(),
                sprintf(
                    '%s/%s/%s/%s',
                    self::FIXTURES_PATH,
                    $algorithm,
                    $directory,
                    $file->getFilename()
                ),
                true
            );
        }
    }
}
