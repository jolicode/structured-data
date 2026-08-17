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

use function Castor\http_request;
use function Castor\io;

use JoliCode\StructuredData\Audit\AuditOptions;
use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use Symfony\Component\Console\Command\Command;
use Symfony\Contracts\HttpClient\Exception\ExceptionInterface;

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

/**
 * Resolves the CLI argument into the document to validate.
 *
 * The library deliberately does not do this: it never guesses whether a string is
 * a URL, a file path, or a document. Here the input comes from the operator running
 * the command, not from an untrusted source, so both are safe to resolve.
 *
 * @throws RuntimeException when the document cannot be read
 */
function resolveInput(string $fileOrUrl): string
{
    if (preg_match('#^https?://#i', $fileOrUrl)) {
        try {
            return http_request('GET', $fileOrUrl)->getContent();
        } catch (ExceptionInterface $exception) {
            throw new RuntimeException(sprintf('The URL "%s" could not be fetched: %s', $fileOrUrl, $exception->getMessage()), previous: $exception);
        }
    }

    $content = is_file($fileOrUrl) ? @file_get_contents($fileOrUrl) : false;

    if (false === $content) {
        throw new RuntimeException(sprintf('The file "%s" could not be read.', $fileOrUrl));
    }

    return $content;
}

function runValidation(string $fileOrUrl, false|string $specificValidator, bool $withDetails): int
{
    io()->title(sprintf($withDetails ? 'Validating %s' : 'Checking %s', $fileOrUrl));

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

    try {
        $document = resolveInput($fileOrUrl);
    } catch (RuntimeException $exception) {
        io()->error($exception->getMessage());

        return Command::INVALID;
    }

    $audit = $validator->audit($document);
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
                } elseif (is_scalar($subValue) || $subValue instanceof Stringable) {
                    io()->writeln(sprintf('%s   * %s: %s', $prefix, $formattedPath, $subValue));
                } else {
                    io()->writeln(sprintf('%s   * %s', $prefix, $formattedPath));
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
