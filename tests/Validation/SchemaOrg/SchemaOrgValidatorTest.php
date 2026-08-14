<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Tests\Validation;

use JoliCode\StructuredData\Audit\AuditOptions;
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;
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
        string $document,
        bool $isValid,
        array $expectedErrors,
        array $expectedWarnings = [],
        array $expectedDocumentIssues = [],
    ): void {
        // The baselines are recorded with the pending.schema.org reporting
        // enabled, so they also document which fixtures use pending vocabulary.
        // The default, silent behavior is covered by the dedicated
        // testPendingVocabularyUsage* tests below.
        $this->assertValidationResultMatchesExpectations(
            $document,
            $isValid,
            $expectedErrors,
            SchemaOrgValidator::class,
            $expectedWarnings,
            $expectedDocumentIssues,
            reportPendingVocabularyUsage: true,
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

    public function testPendingVocabularyUsageIsIgnoredByDefault(): void
    {
        // "jobTitle" is hosted under pending.schema.org.
        $document = (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Jane Doe',
            'jobTitle' => 'Professor',
        ]);

        $this->validator->setValidator(SchemaOrgValidator::class);
        $audit = $this->validator->audit($document);

        $this->assertSame([], $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
        )));
        $this->assertTrue($audit->isValid());
    }

    public function testPendingVocabularyUsageIsReportedWhenOptedIn(): void
    {
        $document = (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Jane Doe',
            'jobTitle' => 'Professor',
        ]);

        $this->validator->setValidator(SchemaOrgValidator::class);
        $audit = $this->validator->audit($document, reportPendingVocabularyUsage: true);

        /** @var array<string> $warnings */
        $warnings = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
        ));

        $this->assertContains('[SchemaOrg warning] jobTitle: The "jobTitle" property is part of the pending.schema.org extension: it is still under development and subject to change.', $warnings);
        $this->assertTrue($audit->isValid(), 'Pending vocabulary usage is a warning, not an error.');
    }

    public function testPendingVocabularyReportingDoesNotLeakThroughTheValidationCaches(): void
    {
        // Auditing the same document with the same validator instance while
        // toggling the option must never serve a result computed under the
        // other configuration.
        $document = (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Person',
            'name' => 'Jane Doe',
            'jobTitle' => 'Professor',
        ]);

        $this->validator->setValidator(SchemaOrgValidator::class);

        $warningOptions = new AuditOptions(severity: AuditOptions::SEVERITY_WARNING);
        $reported = $this->validator->audit($document, reportPendingVocabularyUsage: true)->getDiagnostic($warningOptions);
        $ignored = $this->validator->audit($document)->getDiagnostic($warningOptions);
        $reportedAgain = $this->validator->audit($document, reportPendingVocabularyUsage: true)->getDiagnostic($warningOptions);

        $this->assertNotSame([], $reported);
        $this->assertSame([], $ignored);
        $this->assertSame($reported, $reportedAgain);
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
        string $document,
        bool $isValid = true,
        array $expectedErrors = [],
        array $expectedWarnings = [],
        array $expectedDocumentIssues = [],
    ): void {
        // See testSchemaOrgValidator about reportPendingVocabularyUsage.
        $this->assertValidationResultMatchesExpectations(
            $document,
            $isValid,
            $expectedErrors,
            SchemaOrgValidator::class,
            $expectedWarnings,
            $expectedDocumentIssues,
            reportPendingVocabularyUsage: true,
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
