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

use JoliCode\StructuredData\Audit\AuditOptions;
use JoliCode\StructuredData\JsonLd\Algorithms;
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Generators\Google\Filesystem as GoogleFilesystem;
use JoliCode\StructuredData\Vocabularies\Generators\SchemaOrg\Filesystem as SchemaOrgFilesystem;
use Symfony\Component\Console\Input\InputOption;

const CACHE_DIR_W3C_TEST_SUITE = __DIR__ . '/../var/cache/w3c-json-ld-api';
const CACHE_DIR_W3C_FRAMING_TEST_SUITE = __DIR__ . '/../var/cache/w3c-json-ld-framing';
const CACHE_DIR_BENCHMARK_FIXTURES = __DIR__ . '/../var/cache/benchmark-fixtures';

// Large, real-world pages used only by the benchmarks. They are downloaded on
// demand rather than committed, and exclusively from hosts JoliCode owns or
// operates, so no third-party page ever lives in the repository. The download is
// host-checked against BENCHMARK_FIXTURE_ALLOWED_DOMAINS below.
const BENCHMARK_FIXTURE_URLS = [
    'jolicode-homepage.html' => 'https://jolicode.com/',
    'jolicode-blog-post.html' => 'https://jolicode.com/blog/jolimediasyliusbundle-a-new-bridge-for-your-sylius-projects',
    'jolicampus-homepage.html' => 'https://jolicampus.com/',
    'jolicampus-formation-symfony.html' => 'https://jolicampus.com/formations/symfony',
    'google-structured-data-intro.html' => 'https://developers.google.com/search/docs/appearance/structured-data/intro-structured-data',
];

// Only these registrable domains (and their subdomains) may be downloaded from.
const BENCHMARK_FIXTURE_ALLOWED_DOMAINS = ['jolicode.com', 'jolicampus.com', 'google.com'];

// Commit of https://github.com/w3c/json-ld-api the test suite is pinned to, so an
// upstream change cannot break an unrelated PR. The weekly scheduled CI run is what
// surfaces upstream drift: bump this SHA (and rerun `castor qa:phpunit:prepare --force`)
// to pick up new W3C tests.
const W3C_TEST_SUITE_REF = '92f07705a0c0ac27aa9bc6fe1322dcc9fad0114d';

// Commit of https://github.com/w3c/json-ld-framing the framing test suite is pinned to.
const W3C_FRAMING_TEST_SUITE_REF = '3bf782ba9a40dd1b143435abe386d38df64f2b47';

/**
 * The project root: the tasks live in ".castor/", one level below it.
 */
function rootDir(): string
{
    return \dirname(__DIR__);
}

/**
 * The directory holding the QA tooling, each with its own Composer installation.
 */
function toolsDir(): string
{
    return \dirname(__DIR__) . '/tools';
}

function suiteFixturesAreMissing(): bool
{
    return !fs()->exists(\sprintf('%s/tests/flatten/output', CACHE_DIR_W3C_TEST_SUITE))
        || !fs()->exists(\sprintf('%s/tests/frame/output', CACHE_DIR_W3C_FRAMING_TEST_SUITE));
}

#[AsTask(description: 'Installs qa tooling')]
function install(): void
{
    // The library's own dependencies. Castor already needs these to boot (the entry
    // point requires vendor/autoload.php), so this is mostly a convenience/no-op that
    // keeps "castor qa:install" a complete one-stop setup once the root vendor exists.
    run(['composer', 'install', '-o']);
    run(['composer', 'install', '-o', '--working-dir', 'tools/php-cs-fixer']);
    run(['composer', 'install', '-o', '--working-dir', 'tools/phpstan']);
    run(['composer', 'install', '-o', '--working-dir', 'tools/phpbench']);
    run(['composer', 'install', '-o', '--working-dir', 'tools/phpunit']);
    run(['composer', 'install', '-o', '--working-dir', 'tools/infection']);
}

#[AsTask(description: 'Updates qa tooling')]
function update(): void
{
    run(['composer', 'update', '-o', '--working-dir', 'tools/php-cs-fixer']);
    run(['composer', 'update', '-o', '--working-dir', 'tools/phpstan']);
    run(['composer', 'update', '-o', '--working-dir', 'tools/phpbench']);
    run(['composer', 'update', '-o', '--working-dir', 'tools/phpunit']);
    run(['composer', 'update', '-o', '--working-dir', 'tools/infection']);
}

#[AsTask(description: 'Runs all QA tasks')]
function all(): int
{
    install();
    $cs = cs();
    $phpstan = phpstan();

    return max($cs, $phpstan);
}

#[AsTask(description: 'Fix CS')]
function cs(bool $dryRun = false, ?string $directory = null): int
{
    if (!is_dir(toolsDir() . '/php-cs-fixer/vendor')) {
        install();
    }

    $command = [toolsDir() . '/php-cs-fixer/vendor/bin/php-cs-fixer', 'fix', '--config', rootDir() . '/.php-cs-fixer.php'];

    if ($dryRun) {
        $command[] = '--dry-run';
        $command[] = '--diff';
    }

    if ($directory) {
        $command[] = $directory;
    }

    return run(
        $command,
        context: context()->withAllowFailure()->withWorkingDirectory(rootDir()),
    )->getExitCode() ?? 1;
}

#[AsTask(description: 'Runs PHPStan')]
function phpstan(): int
{
    if (!is_dir(toolsDir() . '/phpstan/vendor')) {
        install();
    }

    return run(
        toolsDir() . '/phpstan/vendor/bin/phpstan',
        context: context()->withAllowFailure()->withWorkingDirectory(rootDir()),
    )->getExitCode() ?? 1;
}

/**
 * Applies the project coding standards to the freshly generated classes, so that
 * generation is reproducible: regenerating from the same vocabulary definitions
 * always yields a tree identical to the committed one, and CI can assert it with
 * a plain `git diff --exit-code` after running the generation tasks.
 */
function fixGeneratedFilesFormatting(string $vocabulary): void
{
    $directory = match ($vocabulary) {
        'SchemaOrg' => 'src/Vocabularies/Generated/SchemaOrg',
        'Google' => 'src/Vocabularies/Generated/Google',
        default => throw new \InvalidArgumentException(\sprintf('Unknown vocabulary "%s".', $vocabulary)),
    };

    io()->writeln(\sprintf('Applying the coding standards to %s.', $directory));

    // The registry is shared by every vocabulary, and rewritten by each generation.
    if (0 !== cs(directory: $directory) || 0 !== cs(directory: 'src/Vocabularies/Generated/GeneratedClassesRegistry.php')) {
        throw new \RuntimeException('Could not apply the coding standards to the generated files.');
    }
}

#[AsTask(name: 'prepare', namespace: 'qa:phpunit', description: 'Download the W3C tests suite')]
function phpunitPrepare(
    bool $force = false,
    #[AsOption(name: 'ref', mode: InputOption::VALUE_REQUIRED, description: 'Git ref of w3c/json-ld-api to download (defaults to the pinned commit; use "main" to track upstream)')]
    ?string $ref = null,
): void {
    $ref ??= W3C_TEST_SUITE_REF;

    if ($force || suiteFixturesAreMissing()) {
        io()->title(\sprintf('Downloading the W3C tests suite (ref: %s).', $ref));
        fs()->remove(CACHE_DIR_W3C_TEST_SUITE);

        $zipFileName = tempnam(sys_get_temp_dir(), 'w3c-json-ld-api');
        http_download(\sprintf('https://github.com/w3c/json-ld-api/archive/%s.zip', $ref), $zipFileName);

        $zip = new \ZipArchive();
        $zip->open($zipFileName);
        $zip->extractTo(CACHE_DIR_W3C_TEST_SUITE);
        $zip->close();

        foreach (Algorithms::algorithmNames() as $algorithm) {
            foreach (['-in.jsonld' => 'input', '-out.jsonld' => 'output', '-context.jsonld' => 'context'] as $suffix => $directory) {
                $targetDirectory = \sprintf('%s/tests/%s/%s', CACHE_DIR_W3C_TEST_SUITE, $algorithm, $directory);
                fs()->mkdir($targetDirectory);
                $files = finder()
                    ->in(\sprintf('%s/json-ld-api-%s/tests/%s', CACHE_DIR_W3C_TEST_SUITE, $ref, $algorithm))
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
        fs()->remove(\sprintf('%s/json-ld-api-%s', CACHE_DIR_W3C_TEST_SUITE, $ref));

        // copy the context test fixtures
        fs()->mirror(
            rootDir() . '/resources/jsonld/context',
            CACHE_DIR_W3C_TEST_SUITE . '/tests/context',
        );

        // The framing test suite lives in its own W3C repository.
        $framingRef = W3C_FRAMING_TEST_SUITE_REF === $ref || 'main' !== $ref ? W3C_FRAMING_TEST_SUITE_REF : 'main';
        io()->writeln(\sprintf('Downloading the W3C framing tests suite (ref: %s).', $framingRef));
        fs()->remove(CACHE_DIR_W3C_FRAMING_TEST_SUITE);

        $framingZipFileName = tempnam(sys_get_temp_dir(), 'w3c-json-ld-framing');
        http_download(\sprintf('https://github.com/w3c/json-ld-framing/archive/%s.zip', $framingRef), $framingZipFileName);

        $framingZip = new \ZipArchive();
        $framingZip->open($framingZipFileName);
        $framingZip->extractTo(CACHE_DIR_W3C_FRAMING_TEST_SUITE);
        $framingZip->close();

        foreach (['-in.jsonld' => 'input', '-out.jsonld' => 'output', '-frame.jsonld' => 'frame'] as $suffix => $directory) {
            $targetDirectory = \sprintf('%s/tests/frame/%s', CACHE_DIR_W3C_FRAMING_TEST_SUITE, $directory);
            fs()->mkdir($targetDirectory);
            $files = finder()
                ->in(\sprintf('%s/json-ld-framing-%s/tests/frame', CACHE_DIR_W3C_FRAMING_TEST_SUITE, $framingRef))
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

        fs()->remove($framingZipFileName);
        fs()->remove(\sprintf('%s/json-ld-framing-%s', CACHE_DIR_W3C_FRAMING_TEST_SUITE, $framingRef));

        io()->success('W3C tests suite downloaded successfully.');
    } else {
        io()->warning('The W3C tests suite is already downloaded. Use --force to download it again.');
    }
}

#[AsTask(name: 'download-fixtures', namespace: 'qa:phpunit', description: 'Download the (JoliCode-owned) benchmark fixtures')]
function phpunitDownloadFixtures(bool $force = false): void
{
    fs()->mkdir(CACHE_DIR_BENCHMARK_FIXTURES);

    foreach (BENCHMARK_FIXTURE_URLS as $name => $url) {
        $host = parse_url($url, \PHP_URL_HOST);

        if (!benchmarkFixtureHostIsAllowed($host)) {
            throw new \RuntimeException(\sprintf('Refusing to download benchmark fixture "%s": host "%s" is not one of %s.', $name, $host, implode(', ', BENCHMARK_FIXTURE_ALLOWED_DOMAINS)));
        }

        $target = \sprintf('%s/%s', CACHE_DIR_BENCHMARK_FIXTURES, $name);

        if (!$force && fs()->exists($target)) {
            continue;
        }

        io()->writeln(\sprintf('Downloading benchmark fixture "%s" from %s', $name, $url));
        http_download($url, $target);
    }

    io()->success('Benchmark fixtures downloaded successfully.');
}

/**
 * A host is allowed when it equals one of the allow-listed registrable domains or
 * is a subdomain of it (so "developers.google.com" passes for "google.com", but
 * "google.com.evil.example" does not).
 */
function benchmarkFixtureHostIsAllowed(string $host): bool
{
    $host = mb_strtolower($host);

    foreach (BENCHMARK_FIXTURE_ALLOWED_DOMAINS as $domain) {
        if ($host === $domain || str_ends_with($host, '.' . $domain)) {
            return true;
        }
    }

    return false;
}

#[AsTask(name: 'run', description: 'Runs PHPUnit', namespace: 'qa:phpunit')]
function phpunit(
    #[AsOption(name: 'group', shortcut: 'g', mode: InputOption::VALUE_REQUIRED, description: 'Only run tests from the specified group')]
    ?string $group = null,
    #[AsOption(name: 'stop-on-failure', shortcut: 'f', mode: InputOption::VALUE_NONE, description: 'Stop execution upon first failure')]
    ?bool $stopOnFailure = null,
    #[AsOption(name: 'stop-on-error', shortcut: 'e', mode: InputOption::VALUE_NONE, description: 'Stop execution upon first error')]
    ?bool $stopOnError = null,
): int {
    if (!is_dir(toolsDir() . '/phpunit/vendor')) {
        install();
    }

    if (suiteFixturesAreMissing()) {
        phpunitPrepare();
    }

    $command = [
        'php',
        '-d memory_limit=-1',
        toolsDir() . '/phpunit/vendor/bin/phpunit',
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
        context: context()->withAllowFailure()->withWorkingDirectory(rootDir()),
    )->getExitCode() ?? 1;
}

#[AsTask(name: 'coverage', description: 'Runs PHPUnit with code coverage', namespace: 'qa:phpunit')]
function phpunitCoverage(
    #[AsOption(name: 'html', mode: InputOption::VALUE_NONE, description: 'Also generate an HTML report in var/cache/coverage')]
    ?bool $html = null,
): int {
    if (!is_dir(toolsDir() . '/phpunit/vendor')) {
        install();
    }

    if (suiteFixturesAreMissing()) {
        phpunitPrepare();
    }

    $command = [
        'php',
        '-d memory_limit=-1',
    ];

    // Coverage needs a driver: prefer pcov (fast), fall back to xdebug.
    if (\extension_loaded('pcov')) {
        $command[] = '-d pcov.enabled=1';
    } elseif (\extension_loaded('xdebug')) {
        $command[] = '-d xdebug.mode=coverage';
    } else {
        io()->error('No code coverage driver available. Install the pcov (recommended) or xdebug PHP extension.');

        return 1;
    }

    $command = [
        ...$command,
        toolsDir() . '/phpunit/vendor/bin/phpunit',
        'tests',
        '--coverage-text',
        '--coverage-clover=var/cache/coverage/clover.xml',
    ];

    if ($html) {
        $command[] = '--coverage-html=var/cache/coverage/html';
    }

    return run(
        $command,
        context: context()->withAllowFailure()->withWorkingDirectory(rootDir()),
    )->getExitCode() ?? 1;
}

#[AsTask(name: 'infection', description: 'Runs Infection mutation testing on the validator and mapper layers')]
function infection(
    #[AsOption(name: 'min-msi', mode: InputOption::VALUE_REQUIRED, description: 'Fail if the Mutation Score Indicator is below this percentage')]
    ?string $minMsi = null,
): int {
    if (!is_dir(toolsDir() . '/infection/vendor')) {
        install();
    }

    if (suiteFixturesAreMissing()) {
        phpunitPrepare();
    }

    if (!\extension_loaded('pcov') && !\extension_loaded('xdebug')) {
        io()->error('Infection needs a code coverage driver. Install the pcov (recommended) or xdebug PHP extension.');

        return 1;
    }

    $command = [
        toolsDir() . '/infection/vendor/bin/infection',
        '--threads=max',
        '--show-mutations',
    ];

    if (null !== $minMsi) {
        $command[] = '--min-msi=' . $minMsi;
    }

    return run(
        $command,
        context: context()->withAllowFailure()->withWorkingDirectory(rootDir()),
    )->getExitCode() ?? 1;
}

#[AsTask(name: 'examples:baseline', description: 'Update the examples baseline files. Will make all the tests green. Use with CARE!')]
function updateExamplesBaselines(): void
{
    io()->confirm(
        "This command will take the results of the tests and write them in their respective baseline files.\n
        This will change the expected outputs of the tests.\n
        Are you 100% sure the current results of the tests are correct and the baseline is wrong?",
        false,
    );

    updateBaseline(
        'schema-org',
        SchemaOrgFilesystem::SCHEMA_ORG_EXAMPLES_DIR,
        SchemaOrgFilesystem::SCHEMA_ORG_EXAMPLES_DIR . '/../examples-baseline.json',
    );
    updateBaseline(
        'schema-org',
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
    $finder = finder()->files()->in($path)->sortByName();
    $validator = new Validator();
    $validator->setValidator($specificValidator);
    $baseline = [];

    foreach ($finder as $file) {
        $audit = $validator->audit($file->getContents());
        /** @var array<string> $documentIssues */
        $documentIssues = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_DOCUMENT,
        ));
        /** @var array<string> $warningMessages */
        $warningMessages = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
        ));
        /** @var array<string> $errorMessages */
        $errorMessages = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        ));

        $remainingDocumentIssues = $documentIssues;
        $warningsWithoutExtraction = [];

        foreach ($warningMessages as $warningMessage) {
            $matchingDocumentIssueKey = array_find_key(
                $remainingDocumentIssues,
                static fn (string $documentIssue): bool => $documentIssue === $warningMessage,
            );

            if ($matchingDocumentIssueKey) {
                unset($remainingDocumentIssues[$matchingDocumentIssueKey]);

                continue;
            }

            $warningsWithoutExtraction[] = $warningMessage;
        }

        $baseline[$file->getFilename()] = [
            'errors' => $errorMessages,
            'warnings' => $warningsWithoutExtraction,
            'documentIssues' => $documentIssues,
        ];
    }

    fs()->dumpFile(
        $baselinePath,
        json_encode($baseline, \JSON_PRETTY_PRINT | \JSON_THROW_ON_ERROR),
    );
}

#[AsTask(name: 'all', namespace: 'qa:bench', description: 'Run all the benchmarks')]
function bench(): int
{
    return max(
        benchAlgorithms(),
        benchValidators(false),
    );
}

#[AsTask(name: 'algorithms', namespace: 'qa:bench', description: 'Run the algorithms benchmark')]
function benchAlgorithms(): int
{
    if (!is_dir(toolsDir() . '/phpbench/vendor')) {
        install();
    }

    $exitCode = run([
        toolsDir() . '/phpbench/vendor/bin/phpbench',
        'run',
        'tests/Algorithms/Benchmark',
        '--no-interaction',
        '--report=readable',
        '--output=console',
        '--output=html-algorithms',
    ],
        context: context()->withAllowFailure()->withWorkingDirectory(rootDir()),
    )->getExitCode() ?? 1;

    if (0 === $exitCode) {
        $htmlReportPath = rootDir() . '/var/cache/benchmark-results-algorithms.html';
        io()->info(\sprintf('Open HTML benchmark report: file://%s', $htmlReportPath));
    }

    return $exitCode;
}

#[AsTask(name: 'validators', namespace: 'qa:bench', description: 'Run the validators benchmark')]
function benchValidators(
    #[AsOption(name: 'detailed', shortcut: 'd', mode: InputOption::VALUE_NONE, description: 'Run the detailed pipeline breakdown benchmark. CAUTION: this is very slow (several minutes) but provides average timings for each step of the validation process.')]
    bool $detailed,
): int {
    if (!is_dir(toolsDir() . '/phpbench/vendor')) {
        install();
    }

    if ($detailed) {
        return benchValidatorsDetailed();
    }

    $dumpFile = tempnam(sys_get_temp_dir(), 'phpbench-validator-');

    if (false === $dumpFile) {
        throw new \RuntimeException('Could not create a temporary phpbench dump file.');
    }

    $exitCode = run([
        toolsDir() . '/phpbench/vendor/bin/phpbench',
        'run',
        'tests/Validation/Benchmark/JsonLdValidatorBench.php',
        '--no-interaction',
        '--report=readable',
        '--output=console',
        '--output=html-validators',
        '--dump-file=' . $dumpFile,
    ],
        context: context()->withAllowFailure()->withWorkingDirectory(rootDir()),
    )->getExitCode() ?? 1;

    if (0 === $exitCode) {
        $results = loadValidatorBenchResults($dumpFile);
        $jsonLdAverage = averageValidatorBenchStat($results, 'benchJsonLd');
        io()->writeln('');
        io()->success(\sprintf(
            'On average, it took %.6F seconds to validate a JSON-LD file.',
            $jsonLdAverage / 1_000_000,
        ));

        $htmlAverage = averageValidatorBenchStat($results, 'benchHtml');
        io()->success(\sprintf(
            'On average, it took %.6F seconds to validate a web page (without making HTTP calls).',
            $htmlAverage / 1_000_000,
        ));

        $htmlReportPath = rootDir() . '/var/cache/benchmark-results-validators.html';
        io()->info(\sprintf('Open HTML benchmark report: file://%s', $htmlReportPath));
    }

    fs()->remove($dumpFile);

    return $exitCode;
}

function benchValidatorsDetailed(): int
{
    $dumpFile = tempnam(sys_get_temp_dir(), 'phpbench-validator-');

    if (false === $dumpFile) {
        throw new \RuntimeException('Could not create a temporary phpbench dump file.');
    }

    $exitCode = run([
        toolsDir() . '/phpbench/vendor/bin/phpbench',
        'run',
        'tests/Validation/Benchmark/HtmlValidationPipelineBench.php',
        '--no-interaction',
        '--report=readable',
        '--output=console',
        '--output=html-validators',
        '--dump-file=' . $dumpFile,
    ],
        context: context()->withAllowFailure()->withWorkingDirectory(rootDir()),
    )->getExitCode() ?? 1;

    if (0 === $exitCode) {
        summarizeValidatorBenchResults($dumpFile);
    }

    fs()->remove($dumpFile);

    return $exitCode;
}

function summarizeValidatorBenchResults(string $dumpFile): void
{
    $results = loadValidatorBenchResults($dumpFile);
    io()->writeln('');
    summarizeHtmlBenchCategory(
        $results,
        categoryPrefix: 'benchHtmlHomepage',
        categoryLabel: 'a classic homepage - jolicode-homepage.html',
    );
    summarizeHtmlBenchCategory(
        $results,
        categoryPrefix: 'benchHtmlHeavyCourse',
        categoryLabel: 'a documentation page - google-structured-data-intro.html',
    );
    summarizeHtmlBenchCategory(
        $results,
        categoryPrefix: 'benchHtmlBlogListing',
        categoryLabel: 'a listing page - jolicampus-homepage.html',
    );

    $htmlReportPath = rootDir() . '/var/cache/benchmark-results-validators.html';
    io()->info(\sprintf('Open HTML benchmark report: file://%s', $htmlReportPath));
}

/**
 * @param array<string, float> $results
 */
function summarizeHtmlBenchCategory(array $results, string $categoryPrefix, string $categoryLabel): void
{
    io()->writeln('');
    io()->section(\sprintf(
        'Bench results for %s',
        $categoryLabel,
    ));

    $fullProcess = averageValidatorBenchStat($results, $categoryPrefix . 'FullProcess');
    $guessJsonLd = averageValidatorBenchStat($results, $categoryPrefix . 'GuessFormatJsonld');
    $guessRdfa = averageValidatorBenchStat($results, $categoryPrefix . 'GuessFormatRdfa');
    $guessMicrodata = averageValidatorBenchStat($results, $categoryPrefix . 'GuessFormatMicrodata');
    $extractJsonLd = averageValidatorBenchStat($results, $categoryPrefix . 'ExtractDocumentJsonld');
    $extractRdfa = averageValidatorBenchStat($results, $categoryPrefix . 'ExtractDocumentRdfa');
    $extractMicrodata = averageValidatorBenchStat($results, $categoryPrefix . 'ExtractDocumentMicrodata');
    $fullExtraction = averageValidatorBenchStat($results, $categoryPrefix . 'FullExtractionProcess');
    $parseDocument = averageValidatorBenchStat($results, $categoryPrefix . 'ParseDocument');
    $mapDocument = averageValidatorBenchStat($results, $categoryPrefix . 'MapParsedDocument');
    $validateParsed = averageValidatorBenchStat($results, $categoryPrefix . 'ValidateParsedDocument');

    io()->writeln('<fg=blue>Average time taken to run format detection by each extractor:</>');
    io()->writeln(\sprintf(
        "<fg=blue;options=bold>  - jsonld: %.6F seconds \n  - rdfa: %.6F seconds \n  - microdata: %.6F seconds</>",
        convertMicrosecondsToSeconds($guessJsonLd),
        convertMicrosecondsToSeconds($guessRdfa),
        convertMicrosecondsToSeconds($guessMicrodata),
    ));

    io()->writeln('');
    io()->writeln('<fg=blue>Average time taken to run extraction by each extractor:</>');
    io()->writeln(\sprintf(
        "<fg=blue;options=bold>  - jsonld: %.6F seconds \n  - rdfa: %.6F seconds \n  - microdata: %.6F seconds</>",
        convertMicrosecondsToSeconds($extractJsonLd),
        convertMicrosecondsToSeconds($extractRdfa),
        convertMicrosecondsToSeconds($extractMicrodata),
    ));

    io()->writeln('');
    io()->writeln('<fg=blue>Average time taken for a real extraction (detect formats then extract only matching ones):</>');
    io()->writeln(\sprintf(
        '<fg=blue;options=bold>    %.6F seconds</>',
        convertMicrosecondsToSeconds($fullExtraction),
    ));

    io()->writeln('');
    io()->writeln('<fg=blue>Average time taken to parse the extracted document:</>');
    io()->writeln(\sprintf(
        '<fg=blue;options=bold>    %.6F seconds</>',
        convertMicrosecondsToSeconds($parseDocument),
    ));

    io()->writeln('');
    io()->writeln('<fg=blue>Average time taken to map the parsed document:</>');
    io()->writeln(\sprintf(
        '<fg=blue;options=bold>    %.6F seconds</>',
        convertMicrosecondsToSeconds($mapDocument),
    ));

    io()->writeln('');
    io()->writeln('<fg=blue>Average time taken to validate the parsed document:</>');
    io()->writeln(\sprintf(
        '<fg=blue;options=bold>    %.6F seconds</>',
        convertMicrosecondsToSeconds($validateParsed),
    ));

    io()->writeln('');
    io()->writeln('');
    io()->writeln(\sprintf(
        '<fg=cyan><fg=cyan;options=bold>[%.6F seconds]</> taken on average by the full validation process for %s</>',
        convertMicrosecondsToSeconds($fullProcess),
        $categoryLabel,
    ));
}

function convertMicrosecondsToSeconds(float $value): float
{
    return $value / 1_000_000;
}

/**
 * @return array<string, float>
 */
function loadValidatorBenchResults(string $dumpFile): array
{
    $xml = simplexml_load_file($dumpFile);

    if (false === $xml) {
        throw new \RuntimeException(\sprintf('Could not parse phpbench dump file "%s".', $dumpFile));
    }

    $results = [];

    foreach ($xml->suite->benchmark as $benchmark) {
        foreach ($benchmark->subject as $subject) {
            $name = (string) $subject['name'];
            $mean = (float) $subject->variant->stats['mean'];
            $results[$name] = $mean;
        }
    }

    return $results;
}

/**
 * @param array<string, float> $results
 */
function averageValidatorBenchStat(array $results, string $subjectPrefix): float
{
    $matching = [];

    foreach ($results as $subject => $mean) {
        if (str_starts_with($subject, $subjectPrefix)) {
            $matching[] = $mean;
        }
    }

    if (!$matching) {
        throw new \RuntimeException(\sprintf('Missing phpbench results for prefix "%s".', $subjectPrefix));
    }

    return array_sum($matching) / \count($matching);
}
