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

use function Castor\import;
use function Castor\run;

use Symfony\Component\Console\Input\InputOption;

import(__DIR__ . '/tools/castor.php');

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
