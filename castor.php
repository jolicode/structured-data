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
use Castor\Attribute\AsTask;

use function Castor\import;
use function Castor\io;

use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Flatten\Flattener;
use Jolicode\SchemaOrg\JsonLdValidator;
use Jolicode\SchemaOrg\Mapper\MappedError;

require_once __DIR__ . '/vendor/autoload.php';

import(__DIR__ . '/tools/castor.php');
import(__DIR__ . '/tools/generator/castor.php');

#[AsTask(name: 'expand', namespace: 'json-ld', description: 'Applies the expansion algorithm to a JSON-LD document')]
function expand(
    #[AsArgument(name: 'file', description: 'The file to expand')]
    string $fileName,
): void {
    $file = file_get_contents($fileName);

    if (false === $file) {
        io()->error(sprintf('The file "%s" could not be read.', $fileName));

        return;
    }

    $expander = new Expander();
    $result = $expander->parseJson($file);

    if (!is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}

#[AsTask(name: 'flatten', namespace: 'json-ld', description: 'Applies the flatenization algorithm to a JSON-LD document')]
function flatten(
    #[AsArgument(name: 'file', description: 'The file to flatten')]
    string $fileName,
): void {
    $file = file_get_contents($fileName);

    if (false === $file) {
        io()->error(sprintf('The file "%s" could not be read.', $fileName));

        return;
    }

    $flattener = new Flattener();
    $result = $flattener->parseJson($file);

    if (!is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}

#[AsTask(name: 'validate', namespace: 'schema-org', description: 'Validate a local file or a remote URL')]
function validate(
    #[AsArgument(name: 'fileOrUrl', description: 'The file or remote URL to validate')]
    string $fileOrUrl,
): void {
    $validator = new JsonLdValidator();
    $types = $validator->validate($fileOrUrl);

    if (count($types)) {
        io()->success(sprintf('%d types were found in the provided document.', count($types)));
    }

    $hasErrors = false;

    foreach ($types as $type) {
        if ($type->errors) {
            $hasErrors = true;

            foreach ($type->errors as $error) {
                if (MappedError::SEVERITY_ERROR === $error->severity) {
                    io()->error($error->message);
                } else {
                    io()->warning($error->message);
                }

                io()->info(sprintf(
                    'Raised by the %s validator for %s on property "%s". Found on the following lines: %s',
                    $error->validatorName,
                    $error->type ? sprintf('the type "%s"', $error->type) : 'an unknown type (with no @type property)',
                    $error->key,
                    \PHP_EOL . $error->ranges,
                ));
            }
        }
    }

    if (!$hasErrors) {
        io()->success('The provided document structure seems to be valid.');
    }
}
