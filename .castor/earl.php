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

use function Castor\capture;
use function Castor\context;
use function Castor\exit_code;
use function Castor\fs;
use function Castor\io;

use Symfony\Component\Console\Input\InputOption;

const CACHE_DIR_EARL = __DIR__ . '/../var/cache/earl';

const EARL_SUBJECT_IRI = 'https://github.com/jolicode/structured-data';
const EARL_ASSERTOR_IRI = 'https://github.com/xavierlacot';

/**
 * The W3C test suites the EARL report covers, keyed by the PHPUnit test class that
 * runs them. The manifest IRIs are the ones the W3C implementation report
 * consolidates (https://w3c.github.io/json-ld-api/reports/): an assertion must
 * reference the test exactly as the manifest names it, which the fixture file
 * names alone cannot give.
 *
 * A function rather than a constant: Castor loads the task files in alphabetical
 * order, so the cache directory constants of qa.php are not defined yet when this
 * file is parsed.
 *
 * @return array<string, array{name: string, manifest: string, iri: string}>
 */
function earlSuites(): array
{
    return [
        'ExpanderTest' => [
            'name' => 'expand',
            'manifest' => CACHE_DIR_W3C_TEST_SUITE . '/tests/expand-manifest.jsonld',
            'iri' => 'https://w3c.github.io/json-ld-api/tests/expand-manifest',
        ],
        'CompactorTest' => [
            'name' => 'compact',
            'manifest' => CACHE_DIR_W3C_TEST_SUITE . '/tests/compact-manifest.jsonld',
            'iri' => 'https://w3c.github.io/json-ld-api/tests/compact-manifest',
        ],
        'FlattenerTest' => [
            'name' => 'flatten',
            'manifest' => CACHE_DIR_W3C_TEST_SUITE . '/tests/flatten-manifest.jsonld',
            'iri' => 'https://w3c.github.io/json-ld-api/tests/flatten-manifest',
        ],
        'FramerTest' => [
            'name' => 'frame',
            'manifest' => CACHE_DIR_W3C_FRAMING_TEST_SUITE . '/tests/frame-manifest.jsonld',
            'iri' => 'https://w3c.github.io/json-ld-framing/tests/frame-manifest',
        ],
    ];
}

#[AsTask(name: 'earl', description: 'Generate the W3C EARL conformance report of the JSON-LD algorithms, for https://w3c.github.io/json-ld-api/reports/')]
function earl(
    #[AsOption(name: 'release', mode: InputOption::VALUE_REQUIRED, description: 'The library version the report describes (defaults to the closest git tag)')]
    ?string $release = null,
    #[AsOption(name: 'output', mode: InputOption::VALUE_REQUIRED, description: 'Where to write the Turtle report (defaults to var/cache/earl/jolicode-structured-data-earl.ttl)')]
    ?string $output = null,
): int {
    io()->title('Generating the W3C EARL conformance report');

    if (!is_dir(toolsDir() . '/phpunit/vendor')) {
        install();
    }

    if (suiteFixturesAreMissing()) {
        phpunitPrepare();
    }

    fs()->mkdir(CACHE_DIR_EARL);
    $junitFile = CACHE_DIR_EARL . '/junit.xml';
    fs()->remove($junitFile);

    io()->section('Running the W3C test suites');

    $command = [
        'php',
        '-d memory_limit=-1',
        toolsDir() . '/phpunit/vendor/bin/phpunit',
        '--log-junit',
        $junitFile,
        '--no-progress',
    ];

    // One --group per suite: PHPUnit does not split a comma-separated list.
    foreach (earlSuites() as $suite) {
        $command[] = '--group';
        $command[] = $suite['name'];
    }

    $command[] = 'tests/Algorithms';

    // A failing test is not a failure of this task: it is what the report is for,
    // and it shows up as an "earl:failed" outcome.
    exit_code($command);

    if (!fs()->exists($junitFile)) {
        throw new \RuntimeException(\sprintf('PHPUnit did not write its JUnit log to "%s".', $junitFile));
    }

    $outcomes = earlOutcomesFromJunit($junitFile);
    $release ??= earlDefaultRelease();
    $date = new \DateTimeImmutable('now', new \DateTimeZone('UTC'));
    $output ??= \sprintf('%s/jolicode-structured-data-earl.ttl', CACHE_DIR_EARL);

    $assertions = [];
    $summary = [];

    foreach (earlSuites() as $testClass => $suite) {
        $results = $outcomes[$testClass] ?? [];
        $summary[$suite['name']] = ['passed' => 0, 'failed' => 0, 'inapplicable' => 0, 'untested' => 0];

        foreach (earlManifestEntries($suite['manifest']) as $entry) {
            // A test that was not run is either out of scope (it only applies to
            // JSON-LD 1.0 processors) or genuinely untested: the distinction matters
            // in the consolidated report.
            $outcome = $results[$entry['test']] ?? ($entry['jsonLd10Only'] ? 'inapplicable' : 'untested');
            ++$summary[$suite['name']][$outcome];
            $assertions[] = ['test' => $suite['iri'] . $entry['id'], 'outcome' => $outcome];
        }
    }

    fs()->dumpFile($output, earlTurtle($assertions, $release, $date));

    io()->section('Outcomes per suite');
    $rows = [];

    foreach ($summary as $suite => $counts) {
        $rows[] = [$suite, $counts['passed'], $counts['failed'], $counts['inapplicable'], $counts['untested'], array_sum($counts)];
    }

    io()->table(['Suite', 'Passed', 'Failed', 'Inapplicable (JSON-LD 1.0 only)', 'Untested', 'Manifest entries'], $rows);
    io()->success(\sprintf('EARL report for release %s written to %s', $release, $output));
    io()->writeln('Submit it with a pull request adding the file to the "reports/" directory of https://github.com/w3c/json-ld-api.');

    return 0;
}

/**
 * Reads the outcome of every W3C fixture from the JUnit log, keyed by the short
 * name of the test class, then by the fixture input file name.
 *
 * @return array<string, array<string, 'passed'|'failed'|'untested'>>
 */
function earlOutcomesFromJunit(string $junitFile): array
{
    $xml = simplexml_load_file($junitFile);

    if (false === $xml) {
        throw new \RuntimeException(\sprintf('Could not parse the JUnit log "%s".', $junitFile));
    }

    $outcomes = [];

    foreach ($xml->xpath('//testcase') ?: [] as $testCase) {
        $class = (string) $testCase['class'];
        $shortClass = substr($class, (int) strrpos($class, '\\') + 1);

        if (!isset(earlSuites()[$shortClass])) {
            continue;
        }

        if (!preg_match('/ with data set "(.+)"$/', (string) $testCase['name'], $matches)) {
            continue;
        }

        if (isset($testCase->failure) || isset($testCase->error)) {
            $outcome = 'failed';
        } elseif (isset($testCase->skipped)) {
            $outcome = 'untested';
        } else {
            $outcome = 'passed';
        }

        $outcomes[$shortClass][$matches[1]] = $outcome;
    }

    return $outcomes;
}

/**
 * The tests a W3C manifest lists: the fragment identifying each one, the PHPUnit
 * data set name it runs as, and whether it only applies to JSON-LD 1.0 processors.
 *
 * The data set name follows the convention of AbstractJsonLdTestCase: the expected
 * output file with "-out" replaced by "-in" (several manifest entries share an
 * input file but not an expected output), or the input file for a negative test.
 *
 * @return list<array{id: string, test: string, jsonLd10Only: bool}>
 */
function earlManifestEntries(string $manifestFile): array
{
    $content = file_get_contents($manifestFile);

    if (false === $content) {
        throw new \RuntimeException(\sprintf('Could not read the W3C manifest "%s". Run "castor qa:phpunit:prepare --force" to download it.', $manifestFile));
    }

    $manifest = json_decode($content, true, 512, \JSON_THROW_ON_ERROR);

    if (!\is_array($manifest) || !\is_array($manifest['sequence'] ?? null)) {
        throw new \RuntimeException(\sprintf('The W3C manifest "%s" has no "sequence" entry.', $manifestFile));
    }

    $entries = [];

    foreach ($manifest['sequence'] as $test) {
        if (!\is_array($test) || !\is_string($test['@id'] ?? null) || !\is_string($test['input'] ?? null)) {
            continue;
        }

        $option = \is_array($test['option'] ?? null) ? $test['option'] : [];

        $entries[] = [
            'id' => $test['@id'],
            'test' => \is_string($test['expect'] ?? null)
                ? str_replace('-out', '-in', basename($test['expect']))
                : basename($test['input']),
            'jsonLd10Only' => 'json-ld-1.0' === ($option['specVersion'] ?? null),
        ];
    }

    return $entries;
}

function earlDefaultRelease(): string
{
    $tag = trim(capture(['git', 'describe', '--tags', '--abbrev=0'], context()->withAllowFailure()->withQuiet()));

    return '' === $tag ? 'dev-main' : ltrim($tag, 'v');
}

/**
 * @param list<array{test: string, outcome: string}> $assertions
 */
function earlTurtle(array $assertions, string $release, \DateTimeImmutable $date): string
{
    $lines = [
        '@prefix dc: <http://purl.org/dc/terms/> .',
        '@prefix doap: <http://usefulinc.com/ns/doap#> .',
        '@prefix earl: <http://www.w3.org/ns/earl#> .',
        '@prefix foaf: <http://xmlns.com/foaf/0.1/> .',
        '@prefix xsd: <http://www.w3.org/2001/XMLSchema#> .',
        '',
        \sprintf('<%s> a doap:Project, earl:TestSubject, earl:Software ;', EARL_SUBJECT_IRI),
        '  doap:name "jolicode/structured-data" ;',
        '  dc:title "jolicode/structured-data" ;',
        '  doap:description "A PHP toolkit to validate and convert structured data: Schema.org and Google Rich Results validation, microdata/RDFa/JSON-LD extraction, and the W3C JSON-LD 1.1 algorithms."@en ;',
        \sprintf('  doap:homepage <%s> ;', EARL_SUBJECT_IRI),
        \sprintf('  doap:license <%s/blob/main/LICENSE> ;', EARL_SUBJECT_IRI),
        '  doap:programming-language "PHP" ;',
        \sprintf('  doap:developer <%s>, <https://github.com/HedicGuibert> ;', EARL_ASSERTOR_IRI),
        \sprintf('  dc:creator <%s> ;', EARL_ASSERTOR_IRI),
        '  doap:release [',
        \sprintf('    doap:name "jolicode/structured-data %s" ;', $release),
        \sprintf('    doap:revision "%s" ;', $release),
        \sprintf('    doap:created "%s"^^xsd:date', $date->format('Y-m-d')),
        '  ] .',
        '',
        \sprintf('<%s> a foaf:Person, earl:Assertor ;', EARL_ASSERTOR_IRI),
        '  foaf:name "Xavier Lacot" ;',
        \sprintf('  foaf:homepage <%s> .', EARL_ASSERTOR_IRI),
        '',
        '<https://github.com/HedicGuibert> a foaf:Person ;',
        '  foaf:name "Hédic Guibert" ;',
        '  foaf:homepage <https://github.com/HedicGuibert> .',
        '',
    ];

    $timestamp = $date->format('Y-m-d\TH:i:s\Z');

    foreach ($assertions as $assertion) {
        $lines[] = '[ a earl:Assertion ;';
        $lines[] = \sprintf('  earl:assertedBy <%s> ;', EARL_ASSERTOR_IRI);
        $lines[] = \sprintf('  earl:subject <%s> ;', EARL_SUBJECT_IRI);
        $lines[] = \sprintf('  earl:test <%s> ;', $assertion['test']);
        $lines[] = \sprintf('  earl:result [ a earl:TestResult ; earl:outcome earl:%s ; dc:date "%s"^^xsd:dateTime ] ;', $assertion['outcome'], $timestamp);
        $lines[] = '  earl:mode earl:automatic ] .';
        $lines[] = '';
    }

    return implode("\n", $lines);
}
