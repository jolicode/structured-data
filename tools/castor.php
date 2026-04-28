<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace qa;

use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;

use function Castor\context;
use function Castor\finder;
use function Castor\fs;
use function Castor\http_download;
use function Castor\io;
use function Castor\run;

use Jolicode\JsonLd\Algorithms;
use Jolicode\JsonLd\Generator\Google\Filesystem as GoogleFilesystem;
use Jolicode\JsonLd\Generator\SchemaOrg\Filesystem as SchemaOrgFilesystem;
use Jolicode\Vocabularies\Mapper\MappedType;
use Jolicode\Vocabularies\Validator;
use Symfony\Component\Console\Input\InputOption;

const CACHE_DIR_W3C_TEST_SUITE = __DIR__ . '/../var/cache/w3c-json-ld-api';

#[AsTask(description: 'Runs all QA tasks')]
function all(): int
{
    install();
    $cs = cs();
    $phpstan = phpstan();

    return max($cs, $phpstan);
}

#[AsTask(name: 'all', namespace: 'qa:bench', description: 'Run all the benchmarks', aliases: ['bench'])]
function bench(): int
{
    return max(
        benchAlgorithms(),
        benchValidators(),
    );
}

#[AsTask(description: 'Fix CS', aliases: ['cs'])]
function cs(bool $dryRun = false, ?string $directory = null): int
{
    if (!is_dir(__DIR__ . '/php-cs-fixer/vendor')) {
        install();
    }

    $command = [__DIR__ . '/php-cs-fixer/vendor/bin/php-cs-fixer', 'fix', '--config', \dirname(__DIR__) . '/.php-cs-fixer.php'];

    if ($dryRun) {
        $command[] = '--dry-run';
        $command[] = '--diff';
    }

    if ($directory) {
        $command[] = $directory;
    }

    return run(
        $command,
        context: context()->withAllowFailure()->withWorkingDirectory(\dirname(__DIR__)),
    )->getExitCode();
}

#[AsTask(description: 'Runs PHPStan', aliases: ['phpstan'])]
function phpstan(): int
{
    if (!is_dir(__DIR__ . '/phpstan/vendor')) {
        install();
    }

    return run(
        __DIR__ . '/phpstan/vendor/bin/phpstan',
        context: context()->withAllowFailure()->withWorkingDirectory(\dirname(__DIR__)),
    )->getExitCode();
}

#[AsTask(name: 'prepare', namespace: 'qa:phpunit', description: 'Download the W3C tests suite')]
function phpunitPrepare(
    bool $force = false,
): void {
    if ($force || !fs()->exists(\sprintf('%s/tests/flatten/output', CACHE_DIR_W3C_TEST_SUITE))) {
        io()->title('Downloading the W3C tests suite.');
        fs()->remove(CACHE_DIR_W3C_TEST_SUITE);

        $zipFileName = tempnam(sys_get_temp_dir(), 'w3c-json-ld-api');
        http_download('https://github.com/w3c/json-ld-api/archive/main.zip', $zipFileName);

        $zip = new \ZipArchive();
        $zip->open($zipFileName);
        $zip->extractTo(CACHE_DIR_W3C_TEST_SUITE);
        $zip->close();

        foreach (Algorithms::algorithmNames() as $algorithm) {
            foreach (['-in.jsonld' => 'input', '-out.jsonld' => 'output'] as $suffix => $directory) {
                $targetDirectory = \sprintf('%s/tests/%s/%s', CACHE_DIR_W3C_TEST_SUITE, $algorithm, $directory);
                fs()->mkdir($targetDirectory);
                $files = finder()
                    ->in(\sprintf('%s/json-ld-api-main/tests/%s', CACHE_DIR_W3C_TEST_SUITE, $algorithm))
                    ->files()
                    ->name('*' . $suffix)
                ;

                foreach ($files as $file) {
                    fs()->copy(
                        $file->getPathname(),
                        \sprintf('%s/%s', $targetDirectory, $file->getFilename()),
                        true,
                    );
                }
            }
        }

        // remove the zip archive and all the files
        fs()->remove($zipFileName);
        fs()->remove(\sprintf('%s/json-ld-api-main', CACHE_DIR_W3C_TEST_SUITE));

        // copy the context test fixtures
        fs()->mirror(
            __DIR__ . '/../resources/jsonld/context',
            CACHE_DIR_W3C_TEST_SUITE . '/tests/context',
        );

        io()->success('W3C tests suite downloaded successfully.');
    } else {
        io()->warning('The W3C tests suite is already downloaded. Use --force to download it again.');
    }
}

#[AsTask(name: 'run', description: 'Runs PHPUnit', namespace: 'qa:phpunit', aliases: ['phpunit', 'test', 'tests'])]
function phpunit(
    #[AsOption(name: 'group', shortcut: 'g', mode: InputOption::VALUE_REQUIRED, description: 'Only run tests from the specified group')]
    ?string $group = null,
    #[AsOption(name: 'stop-on-failure', shortcut: 'f', mode: InputOption::VALUE_NONE, description: 'Stop execution upon first failure')]
    ?bool $stopOnFailure = null,
    #[AsOption(name: 'stop-on-error', shortcut: 'e', mode: InputOption::VALUE_NONE, description: 'Stop execution upon first error')]
    ?bool $stopOnError = null,
): int {
    if (!is_dir(__DIR__ . '/phpunit/vendor')) {
        install();
    }

    if (!fs()->exists(\sprintf('%s/tests/flatten/output', CACHE_DIR_W3C_TEST_SUITE))) {
        phpunitPrepare();
    }

    $command = [
        'php',
        '-d memory_limit=-1',
        __DIR__ . '/phpunit/vendor/bin/phpunit',
        'tests',
    ];

    if ($group) {
        $command[] = '--group';
        $command[] = $group;
    }

    if ($stopOnFailure) {
        $command[] = '--stop-on-failure';
    }

    if ($stopOnError) {
        $command[] = '--stop-on-error';
    }

    return run(
        $command,
        context: context()->withAllowFailure()->withWorkingDirectory(\dirname(__DIR__)),
    )->getExitCode();
}

#[AsTask(name: 'examples:baseline', description: 'Update the schema.org examples baseline file. Will make all the tests green. Use with CARE!')]
function updateSchemaOrgExamplesBaseline(): void
{
    io()->confirm(
        "This command will take the results of the tests and write them in their respective baseline files.\n
        This will change the expected outputs of the tests.\n
        Are you 100% sure the current results of the tests are correct?",
        false,
    );

    updateBaseline(
        'schemaorg',
        SchemaOrgFilesystem::SCHEMA_ORG_EXAMPLES_DIR,
        SchemaOrgFilesystem::SCHEMA_ORG_EXAMPLES_DIR . '/../examples-baseline.json',
    );
    updateBaseline(
        'schemaorg',
        SchemaOrgFilesystem::SCHEMA_ORG_FIXTURES_DIR,
        SchemaOrgFilesystem::SCHEMA_ORG_FIXTURES_DIR . '/../schema-org-baseline.json',
    );
    updateBaseline(
        'google',
        GoogleFilesystem::GOOGLE_FIXTURES_DIR,
        GoogleFilesystem::GOOGLE_FIXTURES_DIR . '/../google-baseline.json',
    );
}

function updateBaseline(
    string $specificValidator,
    string $path,
    string $baselinePath,
): void {
    $finder = finder()->files()->in($path)->name('*.jsonld')->sortByName();
    $validator = new Validator();
    $validator->setValidator($specificValidator);
    $baseline = [];

    foreach ($finder as $file) {
        $types = $validator->getTypes($file->getContents());
        $errorMessages = [];
        $typesWithError = array_filter(
            $types,
            static fn (MappedType $type) => (bool) $type->errors,
        );

        if (\count($typesWithError) > 0) {
            foreach ($typesWithError as $typeWithError) {
                $errorMessages = array_merge($errorMessages, $typeWithError->getErrorMessages(true));
            }

            $baseline[$file->getFilename()] = $errorMessages;
        }
    }

    fs()->dumpFile(
        $baselinePath,
        json_encode($baseline, \JSON_PRETTY_PRINT),
    );
}

#[AsTask(name: 'algorithms', namespace: 'qa:bench', description: 'Run the algorithms benchmark')]
function benchAlgorithms(): int
{
    if (!is_dir(__DIR__ . '/phpbench/vendor')) {
        install();
    }

    return run([
        __DIR__ . '/phpbench/vendor/bin/phpbench',
        'run',
        'tests/Algorithms/Benchmark',
        '--report=aggregate',
    ],
        context: context()->withAllowFailure()->withWorkingDirectory(\dirname(__DIR__)),
    )->getExitCode();
}

#[AsTask(name: 'validators', namespace: 'qa:bench', description: 'Run the validators benchmark')]
function benchValidators(): int
{
    if (!is_dir(__DIR__ . '/phpbench/vendor')) {
        install();
    }

    return run([
        __DIR__ . '/phpbench/vendor/bin/phpbench',
        'run',
        'tests/Validation/Benchmark',
        '--report=aggregate',
    ],
        context: context()->withAllowFailure()->withWorkingDirectory(\dirname(__DIR__)),
    )->getExitCode();
}
