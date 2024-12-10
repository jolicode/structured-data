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
use function Castor\run;

use Symfony\Component\Console\Input\InputOption;

#[AsTask(description: 'Runs all QA tasks')]
function all(): int
{
    install();
    $cs = cs();
    $phpstan = phpstan();
    $phpunit = phpunit();

    return max($cs, $phpstan, $phpunit);
}

#[AsTask(name: 'all', namespace: 'qa:bench', description: 'Run all the benchmarks', aliases: ['bench'])]
function bench(): int
{
    return max(
        benchAlgorithms(),
        benchValidators(),
    );
}

#[AsTask(description: 'Installs qa tooling')]
function install(): void
{
    run(['composer', 'install', '-o', '--working-dir', __DIR__ . '/php-cs-fixer']);
    run(['composer', 'install', '-o', '--working-dir', __DIR__ . '/phpstan']);
    run(['composer', 'install', '-o', '--working-dir', __DIR__ . '/phpbench']);
    run(['composer', 'install', '-o', '--working-dir', __DIR__ . '/phpunit']);
}

#[AsTask(description: 'Updates qa tooling')]
function update(): void
{
    run(['composer', 'update', '-o', '--working-dir', __DIR__ . '/php-cs-fixer']);
    run(['composer', 'update', '-o', '--working-dir', __DIR__ . '/phpstan']);
    run(['composer', 'update', '-o', '--working-dir', __DIR__ . '/phpbench']);
    run(['composer', 'update', '-o', '--working-dir', __DIR__ . '/phpunit']);
}

#[AsTask(description: 'Fix CS', aliases: ['cs'])]
function cs(bool $dryRun = false): int
{
    if (!is_dir(__DIR__ . '/php-cs-fixer/vendor')) {
        install();
    }

    $command = [__DIR__ . '/php-cs-fixer/vendor/bin/php-cs-fixer', 'fix', '--config', \dirname(__DIR__) . '/.php-cs-fixer.php'];

    if ($dryRun) {
        $command[] = '--dry-run';
        $command[] = '--diff';
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

#[AsTask(description: 'Runs PHPUnit', aliases: ['phpunit'])]
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
