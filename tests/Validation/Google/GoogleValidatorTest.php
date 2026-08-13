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
use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;

#[CoversClass(Validator::class)]
#[CoversClass(GoogleValidator::class)]
#[Group('validation')]
#[Group('google')]
class GoogleValidatorTest extends AbstractValidatorTestCase
{
    #[DataProvider('provideGoogleFiles')]
    public function testGoogleValidator(
        string $document,
        bool $isValid,
        array $expectedErrors,
        array $expectedWarnings = [],
        array $expectedDocumentIssues = [],
    ): void {
        $this->assertValidationResultMatchesExpectations(
            $document,
            $isValid,
            $expectedErrors,
            GoogleValidator::class,
            $expectedWarnings,
            $expectedDocumentIssues,
        );
    }

    public function testGoogleValidatorReportsMixedCaseTypeAndPropertyKeys(): void
    {
        $document = file_get_contents(__DIR__ . '/../fixtures/google/movie.jsonld');
        $this->assertNotFalse($document);

        $document = str_replace('"@type": "Movie"', '"@type": "mOVie"', $document);
        $document = str_replace('"image": "https://example.com/photos/inception.jpg"', '"Image": "https://example.com/photos/inception.jpg"', $document);

        $this->validator->setValidator(GoogleValidator::class);
        $audit = $this->validator->audit($document);

        /** @var array<string> $errors */
        $errors = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        ));

        $this->assertContains('[Google error] @type: Incorrect type casing: "mOVie" given, expected "Movie".', $errors);
        $this->assertContains('[Google error] image: Incorrect property casing: "Image" given, expected "image".', $errors);
    }

    public function testItClassifiesInvalidRequiredEnumValueAsError(): void
    {
        $this->validator->setValidator(GoogleValidator::class);
        $audit = $this->validator->audit($this->fixture(__DIR__ . '/../../../resources/schema.org/examples/https-schema-org-de234a27a5e64008c7bfb7ccb04d9504.jsonld'));

        $errors = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        ));
        /** @var array<string> $errors */
        $matchingError = $this->findMessageBySubstring($errors, 'Incorrect value: "EBook/DAISY3"');

        $this->assertNotNull($matchingError);
        $this->assertStringContainsString('Incorrect value: "EBook/DAISY3"', $matchingError);
    }

    public function testItClassifiesInvalidRecommendedEnumValueAsWarning(): void
    {
        $this->validator->setValidator(GoogleValidator::class);
        $audit = $this->validator->audit($this->fixture(__DIR__ . '/../fixtures/google/softwareapplication-invalid-category.jsonld'));

        $warnings = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
        ));
        /** @var array<string> $warnings */
        $matchingWarning = $this->findMessageBySubstring($warnings, 'Incorrect value: "NotAValidCategory"');

        $this->assertNotNull($matchingWarning);
        $this->assertStringContainsString('Incorrect value: "NotAValidCategory"', $matchingWarning);
    }

    public function testItKeepsRootTypeErrorSeverityWhenTypeEntryIsAnArray(): void
    {
        $this->validator->setValidator(GoogleValidator::class);

        $document = file_get_contents(__DIR__ . '/../../../resources/schema.org/examples/https-schema-org-de234a27a5e64008c7bfb7ccb04d9504.jsonld');
        $this->assertNotFalse($document);

        $document = str_replace('"@type": "Book"', '"@type": ["Book"]', $document);

        $audit = $this->validator->audit($document);
        $types = $audit->getTypes();

        $this->assertNotSame([], $types);
        $this->assertSame(MappedError::SEVERITY_ERROR, $types[0]->getErrorSeverity());
    }

    public function testItCanReturnDiagnosticsAsJsonMessages(): void
    {
        $this->validator->setValidator(GoogleValidator::class);

        $audit = $this->validator->audit($this->fixture(__DIR__ . '/../fixtures/google/softwareapplication-invalid-category.jsonld'));
        $diagnosticJson = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
            jsonEncode: true,
        ));

        $this->assertIsString($diagnosticJson);

        $decoded = json_decode($diagnosticJson, true);
        $this->assertIsArray($decoded);

        /** @var array<string> $decoded */
        $matchingWarning = $this->findMessageBySubstring($decoded, 'Incorrect value: "NotAValidCategory"');

        $this->assertNotNull($matchingWarning);
    }

    public function testItCanReturnDiagnosticsAsJsonObjects(): void
    {
        $this->validator->setValidator(GoogleValidator::class);

        $audit = $this->validator->audit($this->fixture(__DIR__ . '/../fixtures/google/softwareapplication-invalid-category.jsonld'));
        $diagnosticJson = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
            asObject: true,
            jsonEncode: true,
        ));

        $this->assertIsString($diagnosticJson);

        $decoded = json_decode($diagnosticJson, true);
        $this->assertIsArray($decoded);
        $this->assertNotSame([], $decoded);
        $this->assertArrayHasKey('message', $decoded[0]);
        $this->assertArrayHasKey('severity', $decoded[0]);
    }

    public function testRootArrayTypeEntryPassesWhenOneCandidateFails(): void
    {
        $this->assertDocumentIsValidForValidator(
            $this->fixture(__DIR__ . '/../fixtures/google/course-multiple-types-one-candidate-fails.jsonld'),
            GoogleValidator::class,
        );
    }

    public function testNestedArrayTypeEntryPassesWhenOneTargetCandidateFails(): void
    {
        $this->assertDocumentIsValidForValidator(
            $this->fixture(__DIR__ . '/../fixtures/google/carousel-all-in-one-course-multiple-types-item.jsonld'),
            GoogleValidator::class,
        );
    }

    public static function provideGoogleFiles(): \Generator
    {
        return self::provideData(
            __DIR__ . '/../fixtures/google',
            __DIR__ . '/../fixtures/google-baseline.json',
        );
    }

    /**
     * @param array<string> $messages
     */
    private function findMessageBySubstring(array $messages, string $messageSubstring): ?string
    {
        foreach ($messages as $message) {
            if (str_contains($message, $messageSubstring)) {
                return $message;
            }
        }

        return null;
    }
}
