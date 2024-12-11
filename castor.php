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

require_once __DIR__ . '/vendor/autoload.php';

import(__DIR__ . '/tools/castor.php');
import(__DIR__ . '/tools/generator/castor.php');

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
