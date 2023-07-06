<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Algorithms\Fixtures;

use Jolicode\JsonLd\Tests\Algorithms\AbstractJsonLdTestCase;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

class FixturesInstaller
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

    private const W3C_ARCHIVE = AbstractJsonLdTestCase::VAR_DIR . '/w3c-tests.zip';

    private static ?Logger $logger = null;

    public static function installFixtures(): void
    {
        $logger = self::getLogger();

        $logger->notice('Starting the download of the W3C test suite.');
        self::downloadW3CArchive();
        $logger->notice('Successfully downloaded the W3C test suite. It is located here : ' . AbstractJsonLdTestCase::VAR_DIR);

        $logger->notice('Starting assigning the tests files to their location.');
        self::assignTestFiles();
        $logger->notice('Successfully assigned the tests files to their location.');
    }

    /**
     * @param bool $generateAnew if set to true, will reinstall the test suite
     */
    public static function resetFixtures(bool $generateAnew = false): void
    {
        $finder = new Finder();
        $filesystem = new Filesystem();
        $logger = self::getLogger();

        $logger->notice('Starting removing the W3C test suite.');

        foreach (self::ALGORITHMS as $algorithm) {
            $inputFiles = $finder
                ->in(sprintf('%s/%s/input', AbstractJsonLdTestCase::FIXTURES_PATH, $algorithm))
                ->files()
                ->ignoreDotFiles(true);
            $filesystem->remove($inputFiles);

            $outputFiles = $finder
                ->in(sprintf('%s/%s/output', AbstractJsonLdTestCase::FIXTURES_PATH, $algorithm))
                ->files()
                ->ignoreDotFiles(true);
            $filesystem->remove($outputFiles);
        }

        $filesystem->remove(AbstractJsonLdTestCase::VAR_DIR);

        $logger->notice('Successfully removed the W3C test suite.');

        if ($generateAnew) {
            self::installFixtures();
        }
    }

    private static function downloadW3CArchive(): void
    {
        $filesystem = new Filesystem();
        $filesystem->dumpFile(
            self::W3C_ARCHIVE,
            file_get_contents('https://github.com/w3c/json-ld-api/archive/main.zip')
        );

        $zip = new \ZipArchive();
        $zip->open(self::W3C_ARCHIVE);
        $zip->extractTo(AbstractJsonLdTestCase::VAR_DIR);
        $zip->close();
    }

    private static function assignTestFiles(): void
    {
        $logger = self::getLogger();

        foreach (self::ALGORITHMS as $algorithm) {
            // First we copy all the input files to the input directory
            self::copyW3CFiles($algorithm, '/-in.jsonld/', 'input');
            // Then the output files to the output directory ^___^
            self::copyW3CFiles($algorithm, '/-out.jsonld/', 'output');

            $logger->notice(sprintf(
                'Copied the %s files to their location : %s/%s',
                $algorithm,
                AbstractJsonLdTestCase::FIXTURES_PATH,
                $algorithm,
            ));
        }
    }

    private static function copyW3CFiles(string $algorithm, string $regex, string $directory): void
    {
        $finder = new Finder();
        $filesystem = new Filesystem();

        $files = $finder
            ->in(sprintf('%s/json-ld-api-main/tests/%s', AbstractJsonLdTestCase::VAR_DIR, $algorithm))
            ->files()
            ->filter(
                fn (\SplFileInfo $file) => preg_match($regex, $file->getFilename()) ? $file : false
            );

        foreach ($files as $file) {
            $filesystem->copy(
                $file->getPathname(),
                sprintf(
                    '%s/%s/%s/%s',
                    AbstractJsonLdTestCase::FIXTURES_PATH,
                    $algorithm,
                    $directory,
                    $file->getFilename()
                ),
                true
            );
        }
    }

    private static function getLogger(): Logger
    {
        if (!self::$logger) {
            self::$logger = new Logger('FixturesLogger');
            self::$logger->pushHandler(new StreamHandler('php://stdout'));
        }

        return self::$logger;
    }
}
