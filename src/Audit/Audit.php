<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Audit;

use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use JoliCode\StructuredData\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;

final class Audit
{
    /**
     * @var array<MappedError>
     */
    private array $byWarnings = [];

    /**
     * @var array<MappedError>
     */
    private array $byErrors = [];

    /**
     * @var array<MappedError>
     */
    private array $byGoogle = [];

    /**
     * @var array<MappedError>
     */
    private array $bySchemaOrg = [];

    /**
     * @var array<MappedError>
     */
    private array $byDocument = [];

    /**
     * @var array<MappedError>
     */
    private array $full = [];

    /**
     * @param array<MappedType>  $types
     * @param array<MappedError> $documentIssues
     */
    public function __construct(
        private array $types = [],
        private array $documentIssues = [],
    ) {
        $this->sort();
    }

    public function isValid(): bool
    {
        return !$this->byErrors;
    }

    public function isFullyValid(): bool
    {
        return !$this->byErrors && !$this->byWarnings;
    }

    /**
     * @return array<MappedType>
     */
    public function getTypes(): array
    {
        return $this->types;
    }

    /**
     * Returns validation errors for the provided input.
     *
     * If no query is provided, returns all errors as string messages.
     * If a query is provided, the output can be filtered, grouped, and returned
     * as either messages or MappedError objects.
     *
     * @see JoliCode\StructuredData\Audit\AuditOptions for all available options and their meaning.
     *
     * @return array<string>|array<MappedError>|array<string, array<string>>|array<string, array<MappedError>>|string
     */
    public function getDiagnostic(?AuditOptions $query = null): array|string
    {
        if (!$query) {
            return $this->getMessages($this->full);
        }

        $queryResult = $this->filterBy($query);

        if (!$query->getGroupBy()) {
            $queryResult = $query->asObject()
                ? $queryResult
                : $this->getMessages($queryResult);

            return $this->formatDiagnosticResult($queryResult, $query);
        }

        $queryResult = $this->groupBy($queryResult, $query);

        if ($query->asObject()) {
            return $this->formatDiagnosticResult($queryResult, $query);
        }

        $messages = [];

        foreach ($queryResult as $key => $group) {
            $messages[$key] = $this->getMessages($group);
        }

        $queryResult = $messages;

        return $this->formatDiagnosticResult($queryResult, $query);
    }

    /**
     * @param array<string>|array<MappedError>|array<string, array<string>>|array<string, array<MappedError>> $queryResult
     *
     * @return array<string>|array<MappedError>|array<string, array<string>>|array<string, array<MappedError>>|string
     */
    private function formatDiagnosticResult(array $queryResult, AuditOptions $query): array|string
    {
        if ($query->jsonEncode()) {
            return json_encode($queryResult, \JSON_THROW_ON_ERROR | \JSON_PRETTY_PRINT);
        }

        return $queryResult;
    }

    /**
     * Filters the errors by severity or by validator.
     *
     * @return array<MappedError>
     */
    private function filterBy(AuditOptions $query): array
    {
        if ($severity = $query->getSeverity()) {
            if (AuditOptions::SEVERITY_ERROR === $severity) {
                return $this->byErrors;
            }

            if (AuditOptions::SEVERITY_WARNING === $severity) {
                return $this->byWarnings;
            }

            if (AuditOptions::SEVERITY_DOCUMENT === $severity) {
                return $this->byDocument;
            }

            throw new \InvalidArgumentException(\sprintf('Invalid severity query option provided: %s', $severity));
        }

        if ($validatorName = $query->getValidator()) {
            if (AuditOptions::VALIDATOR_GOOGLE === $validatorName) {
                return $this->byGoogle;
            }

            if (AuditOptions::VALIDATOR_SCHEMA_ORG === $validatorName) {
                return $this->bySchemaOrg;
            }

            if (AuditOptions::VALIDATOR_DOCUMENT === $validatorName) {
                return $this->byDocument;
            }

            throw new \InvalidArgumentException(\sprintf('Invalid validator query option provided: %s', $validatorName));
        }

        return $this->full;
    }

    /**
     * @param array<MappedError> $queryResult
     *
     * @return array<string, array<MappedError>>
     */
    private function groupBy(array $queryResult, AuditOptions $query): array
    {
        $grouped = [];

        foreach ($queryResult as $entry) {
            $key = (string) (AuditOptions::GROUP_BY_VALIDATOR === $query->getGroupBy()
                ? $entry->getValidatorName()
                : $entry->getSeverity());

            $grouped[$key][] = $entry;
        }

        return $grouped;
    }

    /**
     * @param array<MappedError> $queryResult
     *
     * @return array<string>
     */
    private function getMessages(array $queryResult): array
    {
        $messages = array_map(
            static fn (MappedError $entry) => $entry->getFormattedMessage(),
            $queryResult,
        );

        return $messages;
    }

    private function sort(): void
    {
        $this->byErrors = [];
        $this->byWarnings = [];
        $this->byGoogle = [];
        $this->bySchemaOrg = [];
        $this->byDocument = [];
        $this->full = [];

        $callback = function (MappedType $type): void {
            foreach ($type->getMergedErrors() as $error) {
                if (MappedError::SEVERITY_ERROR === $error->getSeverity()) {
                    $this->byErrors[] = $error;
                } else {
                    $this->byWarnings[] = $error;
                }

                // Errors are bucketed strictly by the validator that produced them:
                // an error from a third-party validator belongs to neither bucket
                // (it stays reachable through the unfiltered diagnostics).
                if (GoogleValidator::VALIDATOR_NAME === $error->getValidatorName()) {
                    $this->byGoogle[] = $error;
                } elseif (SchemaOrgValidator::VALIDATOR_NAME === $error->getValidatorName()) {
                    $this->bySchemaOrg[] = $error;
                }

                $this->full[] = $error;
            }
        };

        array_walk($this->types, $callback);

        foreach ($this->documentIssues as $documentIssue) {
            if (MappedError::SEVERITY_ERROR === $documentIssue->getSeverity()) {
                $this->byErrors[] = $documentIssue;
            } else {
                $this->byWarnings[] = $documentIssue;
            }

            $this->byDocument[] = $documentIssue;
            $this->full[] = $documentIssue;
        }
    }
}
