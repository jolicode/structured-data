<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Castor\Attribute\AsArgument;
use Castor\Attribute\AsOption;
use Castor\Attribute\AsTask;

use function Castor\run;

use Symfony\Component\Console\Input\InputOption;

#[AsTask(name: 'cs', description: 'Fix CS violations')]
function cs(
    #[AsOption(name: 'dry-run', description: 'Display CS violations without fixing it')]
    bool $dryRun = false,
): void {
    if ($dryRun) {
        run('vendor/bin/php-cs-fixer fix src --dry-run --diff');
        run('vendor/bin/php-cs-fixer fix tests --dry-run --diff');
    } else {
        run('vendor/bin/php-cs-fixer fix src --verbose');
        run('vendor/bin/php-cs-fixer fix tests --verbose');
    }
}

#[AsTask(name: 'cs-generated', description: 'Fix CS violations in generated files. Use with caution! Very SLOW!')]
function csGenerated(): void
{
    run('php -d memory_limit=-1 vendor/bin/php-cs-fixer fix generated', timeout: 0);
}

#[AsTask(name: 'phpstan', description: 'Run phpstan')]
function phpstan(): void
{
    run('vendor/bin/phpstan analyse -c phpstan.neon');
}

#[AsTask(name: 'test', description: 'Run the tests', aliases: ['tests'])]
function test(
    #[AsOption(name: 'group', shortcut: 'g', mode: InputOption::VALUE_REQUIRED, description: 'Only run tests from the specified group')]
    ?string $group = null,
    #[AsOption(name: 'stop-on-failure', shortcut: 'f', mode: InputOption::VALUE_NONE, description: 'Stop execution upon first failure')]
    ?bool $stopOnFailure = null,
    #[AsOption(name: 'stop-on-error', shortcut: 'e', mode: InputOption::VALUE_NONE, description: 'Stop execution upon first error')]
    ?bool $stopOnError = null,
): void {
    $command = 'php -d memory_limit=-1 vendor/bin/phpunit tests';

    if ($group) {
        $command .= sprintf(' --group %s', $group);
    }

    if ($stopOnFailure) {
        $command .= ' --stop-on-failure';
    }

    if ($stopOnError) {
        $command .= ' --stop-on-error';
    }

    run($command);
}

#[AsTask(name: 'ci', description: 'Run all the CI checks')]
function ci(): void
{
    cs();
    phpstan();
    test();
}

#[AsTask(name: 'delete', namespace: 'fixtures', description: 'Delete all test files')]
function deleteFixtures(): void
{
    run('bin/json-ld remove-fixtures');
}

#[AsTask(name: 'reset', namespace: 'fixtures', description: 'Delete the test files and reinstall them')]
function resetFixtures(): void
{
    run('bin/json-ld remove-fixtures --reset');
}

#[AsTask(name: 'generate', description: 'Generate the PHP classes used to validate JSON-LD')]
function generate(
    #[AsOption(name: 'reset', shortcut: 'r', mode: InputOption::VALUE_NONE, description: 'Reset the generated files')]
    bool $reset,
    #[AsOption(name: 'source', shortcut: 's', mode: InputOption::VALUE_REQUIRED, description: 'Only download from a specific source. Accepted values are "schemaorg" and "google"')]
    ?string $source = null,
): void {
    $command = 'bin/json-ld generate';

    if ($reset) {
        $command .= ' -r';
    }

    if ($source) {
        $command .= sprintf(' -s %s', $source);
    }

    run($command);
}

#[AsTask(name: 'validate', description: 'Validate a local file or a remote URL')]
function validate(
    #[AsArgument(name: 'fileOrUrl', description: 'The file or remote URL to validate')]
    string $fileOrUrl,
    #[AsOption(name: 'validator', mode: InputOption::VALUE_REQUIRED, description: 'The validator to use')]
    ?string $validator = null,
): void {
    $command = sprintf(
        'bin/json-ld validate %s',
        $fileOrUrl,
    );

    if ($validator) {
        $command .= sprintf(' --validator=%s', $validator);
    }

    run($command);
}

#[AsTask(name: 'all', namespace: 'benchmark', description: 'Run all the benchmarks', aliases: ['bench'])]
function bench(): void
{
    benchAlgorithms();
    benchValidators();
}

#[AsTask(name: 'algorithms', namespace: 'benchmark', description: 'Run the algorithms benchmark')]
function benchAlgorithms(): void
{
    run('vendor/bin/phpbench run tests/Algorithms/Benchmark --report=aggregate');
}

#[AsTask(name: 'validators', namespace: 'benchmark', description: 'Run the validators benchmark')]
function benchValidators(): void
{
    run('vendor/bin/phpbench run tests/Validation/Benchmark --report=aggregate');
}

#[AsTask(name: 'expand', namespace: 'algorithms', description: 'Expand a JSON-LD document')]
function expand(
    #[AsArgument(name: 'file', description: 'The file to expand')]
    string $fileName,
): void {
    run('bin/json-ld expand ' . $fileName);
}

#[AsTask(name: 'flatten', namespace: 'algorithms', description: 'Flatten a JSON-LD document')]
function flatten(
    #[AsArgument(name: 'file', description: 'The file to flatten')]
    string $fileName,
): void {
    run('bin/json-ld flatten ' . $fileName);
}
