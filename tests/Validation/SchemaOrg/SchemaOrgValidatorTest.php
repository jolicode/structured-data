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
use Jolicode\JsonLd\Validator;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

#[CoversClass(Validator::class)]
#[CoversClass(SchemaOrgValidator::class)]
#[Group('validation')]
#[Group('schemaorg')]
#[Group('schema-org')]
class SchemaOrgValidatorTest extends AbstractValidatorTestCase
{
    #[DataProvider('provideSchemaOrgFiles')]
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

    public function testSchemaOrgValidatorWarnsAboutSupersededTerms(): void
    {
        // "episodes" is superseded by "episode", "season" by "containsSeason".
        $document = (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'TVSeries',
            'name' => 'My Series',
            'episodes' => ['@type' => 'Episode', 'name' => 'Pilot'],
        ]);

        $this->validator->setValidator(SchemaOrgValidator::class);
        $audit = $this->validator->audit($document);

        /** @var array<string> $warnings */
        $warnings = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
        ));

        $this->assertContains('[SchemaOrg warning] episodes: The "episodes" property is superseded by "episode". Consider using "episode" instead.', $warnings);
        $this->assertTrue($audit->isValid(), 'A superseded term is a warning, not an error.');
    }

    public function testSchemaOrgValidatorWarnsAboutSupersededTypes(): void
    {
        // The "UserInteraction" type tree is superseded by InteractionCounter.
        $document = (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'UserLikes',
            'name' => 'Likes',
        ]);

        $this->validator->setValidator(SchemaOrgValidator::class);
        $audit = $this->validator->audit($document);

        /** @var array<string> $warnings */
        $warnings = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
        ));

        $this->assertContains('[SchemaOrg warning] @type: The "UserLikes" type is superseded by "InteractionCounter". Consider using "InteractionCounter" instead.', $warnings);
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

    #[DataProvider('provideSchemaOrgExamples')]
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

    public static function provideSchemaOrgExamples(): \Generator
    {
        return self::provideData(
            __DIR__ . '/../../../resources/schema.org/examples',
            __DIR__ . '/../../../resources/schema.org/examples-baseline.json',
        );
    }

    public static function provideSchemaOrgFiles(): \Generator
    {
        return self::provideData(
            __DIR__ . '/../fixtures/schema-org',
            __DIR__ . '/../fixtures/schema-org-baseline.json',
        );
    }
}
