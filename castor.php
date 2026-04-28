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
use function Castor\io;
use function Castor\run;

use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Flatten\Flattener;
use Jolicode\Vocabularies\Mapper\MappedError;
use Jolicode\Vocabularies\Mapper\MappedType;
use Jolicode\Vocabularies\Validator;
use Jolicode\Vocabularies\Validators\Google\GoogleValidator;
use Jolicode\Vocabularies\Validators\RegisteredValidatorsContainer;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;

require_once __DIR__ . '/vendor/autoload.php';

import(__DIR__ . '/tools/castor.php');
import(__DIR__ . '/tools/generator/castor.php');

#[AsTask(description: 'Installs qa tooling')]
function install(): void
{
    run(['composer', 'install', '-o', '--working-dir', 'tools/php-cs-fixer']);
    run(['composer', 'install', '-o', '--working-dir', 'tools/phpstan']);
    run(['composer', 'install', '-o', '--working-dir', 'tools/phpbench']);
    run(['composer', 'install', '-o', '--working-dir', 'tools/phpunit']);
}

#[AsTask(description: 'Updates qa tooling')]
function update(): void
{
    run(['composer', 'update', '-o', '--working-dir', 'tools/php-cs-fixer']);
    run(['composer', 'update', '-o', '--working-dir', 'tools/phpstan']);
    run(['composer', 'update', '-o', '--working-dir', 'tools/phpbench']);
    run(['composer', 'update', '-o', '--working-dir', 'tools/phpunit']);
}

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
    $result = $expander->expand($file);

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
    $result = $flattener->flatten($file);

    if (!is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}

#[AsTask(name: 'validate', namespace: 'schema-org', description: 'Validate a local file or a remote URL')]
function validate(
    #[AsArgument(name: 'fileOrUrl', description: 'The file or remote URL to validate')]
    string $fileOrUrl,
    #[AsArgument(name: 'validator', description: 'The specific validator to use')]
    false|string $specificValidator = false,
    #[AsOption(name: 'details', description: 'Whether to display the details of the validation', shortcut: 'd')]
    bool $withDetails = false,
): void {
    $validator = new Validator();
    $validatorsContainer = new RegisteredValidatorsContainer();

    if ($specificValidator) {
        $validatorClass = $validatorsContainer->getValidatorClassName($specificValidator);

        if (false === $validatorClass) {
            io()->error(sprintf(
                'Invalid validator specified. Accepted values are: "%s", "%s" (case-insensitive).',
                SchemaOrgValidator::VALIDATOR_NAME,
                GoogleValidator::VALIDATOR_NAME,
            ));

            return;
        }

        $validator->setValidator($validatorClass);
    }

    $types = $validator->getTypes($fileOrUrl);

    if (0 === count($types)) {
        io()->warning('No schema.org types were found in the provided document.');
    } else {
        io()->success(sprintf('%d schema.org types were found in the provided document.', count($types)));
    }

    $errorsCount = 0;

    foreach ($types as $type) {
        if ($withDetails) {
            displayType($type);

            if ($type->errors) {
                foreach ($type->errors as $error) {
                    if (MappedError::SEVERITY_ERROR === $error->severity) {
                        io()->error($error->message);
                    } else {
                        io()->warning($error->message);
                    }

                    io()->writeln(sprintf(
                        'The above error was raised for %s on property "%s" (%s). Found on position %s',
                        $error->type ? sprintf('the type "%s"', $error->type) : 'an unknown type (with no @type property)',
                        $error->key,
                        $error->parent?->getKeyPath(),
                        $error->ranges,
                    ));
                }

                io()->writeln('');
            }
        }

        if ($type->errors) {
            foreach ($type->errors as $error) {
                if (MappedError::SEVERITY_ERROR === $error->severity) {
                    ++$errorsCount;
                }
            }
        }
    }

    if (count($types) > 0) {
        if ($errorsCount > 0) {
            io()->error(sprintf('The provided document seems to be invalid. %s out of %s types contain an error.', $errorsCount, count($types)));
        } else {
            io()->success('The provided document seems to be valid.');
        }
    }
}

function displayType(MappedType $type, int $level = 0): void
{
    $prefix = str_repeat('  ', $level);
    io()->writeln(sprintf('%s * %s', $prefix, $type->getKeyPath()));

    foreach ($type->properties as $propertyName => $property) {
        /** @var Jolicode\Vocabularies\Mapper\MappedProperty $property */
        $value = $property->value;

        if (is_string($value)) {
            io()->writeln(sprintf('%s   * %s: %s', $prefix, $property->getKeyPath(), $value));
        } elseif ($value instanceof MappedType) {
            displayType($value, $level + 1);
        } elseif (is_array($value)) {
            foreach ($value as $subValue) {
                if ($subValue instanceof MappedType) {
                    displayType($subValue, $level + 1);
                } else {
                    io()->writeln(sprintf('%s   * %s: %s', $prefix, $property->getKeyPath(), $subValue));
                }
            }
        } else {
            io()->writeln(sprintf('%s   * %s', $prefix, $property->getKeyPath()));
        }
    }
}
