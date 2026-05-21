<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Tests\Validation;

use Jolicode\JsonLd\Audit\AuditOptions;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;

/**
 * @covers \Jolicode\JsonLd\Validator
 * @covers \Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator
 *
 * @group validation
 * @group schemaorg
 * @group schema-org
 */
class SchemaOrgValidatorTest extends AbstractValidatorTestCase
{
    /**
     * @dataProvider provideSchemaOrgFiles
     */
    public function testSchemaOrgValidator(
        string $filePath,
        bool $isValid,
        array $expectedErrors,
        array $expectedWarnings = [],
        array $expectedDocumentIssues = [],
    ): void {
        $this->assertValidationResultMatchesExpectations(
            $filePath,
            $isValid,
            $expectedErrors,
            SchemaOrgValidator::class,
            $expectedWarnings,
            $expectedDocumentIssues,
        );
    }

    public function testSchemaOrgValidatorReportsMixedCaseTypeAndPropertyKeys(): void
    {
        $document = file_get_contents(__DIR__ . '/../fixtures/schema-org/simple-compacted.jsonld');
        $this->assertNotFalse($document);

        $document = str_replace('"@type": "Person"', '"@type": "pErSoN"', $document);
        $document = str_replace('"name": "Jane Doe"', '"Name": "Jane Doe"', $document);

        $this->validator->setValidator(SchemaOrgValidator::class);
        $audit = $this->validator->audit($document);

        /** @var array<string> $errors */
        $errors = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        ));

        $this->assertContains('[SchemaOrg error] @type: Incorrect type casing: "pErSoN" given, expected "Person".', $errors);
        $this->assertContains('[SchemaOrg error] name: Incorrect property casing: "Name" given, expected "name".', $errors);
    }

    /**
     * @dataProvider provideSchemaOrgExamples
     */
    public function testSchemaOrgExamples(
        string $filePath,
        bool $isValid = true,
        array $expectedErrors = [],
        array $expectedWarnings = [],
        array $expectedDocumentIssues = [],
    ): void {
        $this->assertValidationResultMatchesExpectations(
            $filePath,
            $isValid,
            $expectedErrors,
            SchemaOrgValidator::class,
            $expectedWarnings,
            $expectedDocumentIssues,
        );
    }

    public function provideSchemaOrgExamples(): \Generator
    {
        return $this->provideData(
            __DIR__ . '/../../../resources/schema.org/examples',
            __DIR__ . '/../../../resources/schema.org/examples-baseline.json',
        );
    }

    public function provideSchemaOrgFiles(): \Generator
    {
        return $this->provideData(
            __DIR__ . '/../fixtures/schema-org',
            __DIR__ . '/../fixtures/schema-org-baseline.json',
        );
    }
}
