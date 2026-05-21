<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Audit;

final readonly class AuditOptions
{
    public const SEVERITY_ERROR = 'error';
    public const SEVERITY_WARNING = 'warning';
    public const SEVERITY_DOCUMENT = 'document';

    public const VALIDATOR_GOOGLE = 'google';
    public const VALIDATOR_SCHEMA_ORG = 'schema.org';
    public const VALIDATOR_DOCUMENT = 'document';

    public const GROUP_BY_VALIDATOR = 'validator';
    public const GROUP_BY_SEVERITY = 'severity';

    /**
     * A list of options used by Audit::getDiagnostic() to return the desired format.
     *
     * @param ?string $severity
     *                          Filter by severity.
     *
     *  - `null (default)`: all severities
     *  - `AuditOptions::SEVERITY_ERROR`
     *  - `AuditOptions::SEVERITY_WARNING`
     *  - `AuditOptions::SEVERITY_DOCUMENT`: document-level issues found while validating the user input (already included with warnings and errors).
     * @param ?string $validator
     *                           Filter by source name.
     *
     *  - `null (default)`: all sources
     *  - `AuditOptions::VALIDATOR_GOOGLE`
     *  - `AuditOptions::VALIDATOR_SCHEMA_ORG`
     *  - `AuditOptions::VALIDATOR_DOCUMENT`: document-level issues found while parsing/extracting
     * @param ?string $groupBy
     *                         Group results instead of returning a flat list.
     *
     *  - `null (default)`: no grouping, flat list
     *  - `AuditOptions::GROUP_BY_VALIDATOR`
     *  - `AuditOptions::GROUP_BY_SEVERITY`
     * @param bool $asObject
     *                       Defines output format
     *
     *  - `false (default)`: returns string error messages
     *  - `true`: returns MappedError objects
     * @param bool $jsonEncode
     *                         When true, returns a JSON payload instead of arrays
     */
    public function __construct(
        private ?string $severity = null,
        private ?string $validator = null,
        private ?string $groupBy = null,
        private bool $asObject = false,
        private bool $jsonEncode = false,
    ) {
    }

    public function getSeverity(): ?string
    {
        return $this->severity;
    }

    public function getValidator(): ?string
    {
        return $this->validator;
    }

    public function getGroupBy(): ?string
    {
        return $this->groupBy;
    }

    public function asObject(): bool
    {
        return $this->asObject;
    }

    public function jsonEncode(): bool
    {
        return $this->jsonEncode;
    }
}
