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
use function Castor\run;

use Jolicode\JsonLd\Algorithms\Compact\Compactor;
use Jolicode\JsonLd\Algorithms\Expand\Expander;
use Jolicode\JsonLd\Algorithms\Flatten\Flattener;
use Jolicode\JsonLd\Algorithms\Frame\Framer;
use Jolicode\JsonLd\Audit\AuditOptions;
use Jolicode\JsonLd\Mapper\MappedError;
use Jolicode\JsonLd\Mapper\MappedProperty;
use Jolicode\JsonLd\Mapper\MappedType;
use Jolicode\JsonLd\Validator;
use Jolicode\Vocabularies\Validators\Google\GoogleValidator;
use Symfony\Component\Console\Command\Command;

require_once __DIR__ . '/vendor/autoload.php';

import(__DIR__ . '/tools/castor.php');

#[AsTask(description: 'Installs qa tooling')]
function install(): void
{
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

#[AsTask(name: 'compact', namespace: 'json-ld', description: 'Applies the compaction algorithm to a JSON-LD document, using the provided context')]
function compactJsonLd(
    #[AsArgument(name: 'file', description: 'The file to compact')]
    string $fileName,
    #[AsArgument(name: 'context-file', description: 'The file holding the context to compact against')]
    string $contextFileName,
): void {
    $file = file_get_contents($fileName);
    $context = file_get_contents($contextFileName);

    if (false === $file || false === $context) {
        io()->error(sprintf('The file "%s" or "%s" could not be read.', $fileName, $contextFileName));

        return;
    }

    $compactor = new Compactor();
    $result = $compactor->compact($file, $context);

    if (!is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}

#[AsTask(name: 'frame', namespace: 'json-ld', description: 'Applies the framing algorithm to a JSON-LD document, using the provided frame')]
function frameJsonLd(
    #[AsArgument(name: 'file', description: 'The file to frame')]
    string $fileName,
    #[AsArgument(name: 'frame-file', description: 'The file holding the frame')]
    string $frameFileName,
): void {
    $file = file_get_contents($fileName);
    $frame = file_get_contents($frameFileName);

    if (false === $file || false === $frame) {
        io()->error(sprintf('The file "%s" or "%s" could not be read.', $fileName, $frameFileName));

        return;
    }

    $framer = new Framer();
    $result = $framer->frame($file, $frame);

    if (!is_string($result)) {
        $result = json_encode($result, \JSON_PRETTY_PRINT) ?: '';
    }

    io()->writeln($result);
}

#[AsTask(name: 'check', description: 'quickly check the validity of a file or of a remote URL')]
function check(
    #[AsArgument(name: 'fileOrUrl', description: 'The file or remote URL to validate')]
    string $fileOrUrl,
    #[AsArgument(name: 'validator', description: 'The specific validator to use. Accepted values are: "schema-org", "schemaorg", "google".')]
    false|string $specificValidator = false,
): int {
    return runValidation($fileOrUrl, $specificValidator, false);
}

#[AsTask(name: 'validate', description: 'Fully validate a local file or a remote URL')]
function validate(
    #[AsArgument(name: 'fileOrUrl', description: 'The file or remote URL to validate')]
    string $fileOrUrl,
    #[AsArgument(name: 'validator', description: 'The specific validator to use. Accepted values are: "schema-org", "schemaorg", "google".')]
    false|string $specificValidator = false,
): int {
    return runValidation($fileOrUrl, $specificValidator, true);
}

function runValidation(string $fileOrUrl, false|string $specificValidator, bool $withDetails): int
{
    $validator = new Validator();

    if ($specificValidator) {
        try {
            $validator->setValidator($specificValidator);
        } catch (InvalidArgumentException) {
            io()->error(sprintf(
                'Invalid validator specified. Accepted values are: "%s", "%s" (case-insensitive).',
                'schema-org, schemaorg',
                'google',
            ));

            return Command::INVALID;
        }
    }

    $audit = $validator->audit($fileOrUrl);
    $types = $audit->getTypes();
    $typesCount = count($types);

    if (0 === $typesCount) {
        io()->warning('No schema.org types were found in the provided document.');

        return Command::FAILURE;
    }

    if (1 === $typesCount) {
        io()->info('1 schema.org type was found in the provided document.');
    } else {
        io()->info(sprintf('%d schema.org types were found in the provided document.', $typesCount));
    }

    if ($withDetails) {
        foreach ($types as $index => $type) {
            io()->section(sprintf('<fg=blue>Type</> <fg=magenta;options=bold>N°</> <fg=blue>%d</>', $index + 1));

            displayType($type);
            io()->writeln('');

            $hasGoogleErrors = false;
            $hasGoogleWarnings = false;
            $hasSchemaOrgErrors = false;
            $hasSchemaOrgWarnings = false;

            if ($errors = $type->getMergedErrors()) {
                foreach ($errors as $error) {
                    if (MappedError::SEVERITY_ERROR === $error->getSeverity()) {
                        io()->writeln(sprintf('<fg=magenta;options=bold>%s</>', $error->getFormattedMessage()));

                        if (GoogleValidator::VALIDATOR_NAME === $error->getValidatorName()) {
                            $hasGoogleErrors = true;
                        } else {
                            $hasSchemaOrgErrors = true;
                        }
                    } else {
                        io()->writeln(sprintf('<fg=yellow;options=bold>%s</>', $error->getFormattedMessage()));

                        if (GoogleValidator::VALIDATOR_NAME === $error->getValidatorName()) {
                            $hasGoogleWarnings = true;
                        } else {
                            $hasSchemaOrgWarnings = true;
                        }
                    }

                    io()->writeln(sprintf(
                        "<fg=cyan>The above %s was raised for %s%s\nFound on input positions %s (line:col)</>",
                        $error->getSeverity(),
                        $error->getType() ? sprintf('the type "%s"', $error->getType()) : 'an unknown type (with no @type property)',
                        $error->getProperty() ? sprintf(' on its "%s" property', $error->getProperty()) : '',
                        $error->getRanges(),
                    ));
                    io()->writeln('');
                }
            } else {
                io()->writeln('<fg=cyan>Type is fully valid!</>');
                io()->writeln('');
            }

            $googleSpecific = strtolower(GoogleValidator::VALIDATOR_NAME) === $specificValidator;

            if (!$specificValidator || $googleSpecific) {
                io()->writeln(sprintf(
                    '<fg=cyan>Google Validation</>: <fg=%s;options=bold>%s</>',
                    $hasGoogleErrors ? 'magenta' : ($hasGoogleWarnings ? 'yellow' : 'blue'),
                    $hasGoogleErrors ? 'FAILURE' : ($hasGoogleWarnings ? 'WARNINGS' : 'PASSES'),
                ));
            }

            if (!$googleSpecific) {
                io()->writeln(sprintf(
                    '<fg=cyan>Schema.org Validation</>: <fg=%s;options=bold>%s</>',
                    $hasSchemaOrgErrors ? 'magenta' : ($hasSchemaOrgWarnings ? 'yellow' : 'blue'),
                    $hasSchemaOrgErrors ? 'FAILURE' : ($hasSchemaOrgWarnings ? 'WARNINGS' : 'PASSES'),
                ));
            }

            io()->writeln('');
        }
    }

    /** @var array<string> $extractionIssues */
    $extractionIssues = $audit->getDiagnostic(new AuditOptions(
        severity: AuditOptions::SEVERITY_DOCUMENT,
    ));
    /** @var array<string> $warningDiagnostics */
    $warningDiagnostics = $audit->getDiagnostic(new AuditOptions(
        severity: AuditOptions::SEVERITY_WARNING,
    ));
    /** @var array<string> $errorDiagnostics */
    $errorDiagnostics = $audit->getDiagnostic(new AuditOptions(
        severity: AuditOptions::SEVERITY_ERROR,
    ));

    if ($extractionIssues) {
        io()->warning(sprintf('The provided document has some malformed data structures that cannot be parsed or validated. %s extraction issues were found.', count($extractionIssues)));
    }

    if ($warningDiagnostics) {
        io()->warning(sprintf('The provided document has warnings. %s warnings were found.', count($warningDiagnostics)));
    }

    if (!$audit->isValid()) {
        io()->error(sprintf('The provided document is invalid. %s validation errors were found.', count($errorDiagnostics)));

        return Command::FAILURE;
    }

    io()->success('The provided document is a valid JSON-LD object.');

    return Command::SUCCESS;
}

function displayType(MappedType $type, int $level = 0): void
{
    $prefix = str_repeat('  ', $level);

    if ($level) {
        $color = defineDisplayColor($type);
        io()->writeln(sprintf('%s * %s:', $prefix, formatPathDisplay($type->getPath() ?? '', $color)));
    }

    foreach ($type->getProperties() as $property) {
        /** @var MappedProperty $property */
        $value = $property->getValue();
        $color = defineDisplayColor($property);
        $formattedPath = formatPathDisplay($property->getPath(), $color);

        if (is_string($value)) {
            io()->writeln(sprintf('%s   * %s: %s', $prefix, $formattedPath, $value));
        } elseif ($value instanceof MappedType) {
            displayType($value, $level + 1);
        } elseif (is_array($value)) {
            foreach ($value as $subValue) {
                if ($subValue instanceof MappedType) {
                    displayType($subValue, $level + 1);
                } else {
                    io()->writeln(sprintf('%s   * %s: %s', $prefix, $formattedPath, $subValue));
                }
            }
        } else {
            io()->writeln(sprintf('%s   * %s', $prefix, $formattedPath));
        }
    }
}

function defineDisplayColor(MappedType|MappedProperty $object): string
{
    $color = 'blue';

    if ('warning' === $object->getErrorSeverity()) {
        $color = 'yellow';
    }

    if ('error' === $object->getErrorSeverity()) {
        $color = 'magenta';
    }

    return $color;
}

function formatPathDisplay(string $path, string $color): string
{
    $segments = explode('.', $path);
    $lastSegment = array_pop($segments);
    $prefix = !$segments ? '' : implode('.', $segments) . '.';

    // Unreadable but beautiful :D
    return sprintf('<fg=%s>%s</><fg=%s;options=bold>%s</>', $color, $prefix, $color, $lastSegment);
}
