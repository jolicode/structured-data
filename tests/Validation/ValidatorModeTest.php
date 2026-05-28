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
use Jolicode\JsonLd\Mapper\MappedError;
use Jolicode\JsonLd\Mapper\MappedType;
use Jolicode\JsonLd\Validator;
use Jolicode\Vocabularies\Validators\Google\GoogleValidator;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\TestCase;

class ValidatorModeTest extends TestCase
{
    public function testCrossFormatWarningsAreIncluded(): void
    {
        $validator = new Validator();

        $audit = $validator->audit($this->fixture('mixed-valid-jsonld-invalid-microdata.html'));

        /** @var array<string> $documentIssues */
        $documentIssues = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_DOCUMENT,
        ));

        $this->assertCount(1, $documentIssues);
        $this->assertStringContainsString('microdata', $documentIssues[0]);
    }

    public function testRepeatedSnippetValidationKeepsOccurrenceSpecificRanges(): void
    {
        $validator = new Validator();

        $snippet = <<<'JSON'
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "Name": "Example"
}
JSON;

        $firstAudit = $validator->audit("<html>\n<script type=\"application/ld+json\">{$snippet}</script>\n</html>");
        $secondAudit = $validator->audit("<html>\n\n\n<script type=\"application/ld+json\">{$snippet}</script>\n</html>");

        /** @var array<MappedError> $firstErrors */
        $firstErrors = $firstAudit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
            validator: AuditOptions::VALIDATOR_SCHEMA_ORG,
            asObject: true,
        ));

        /** @var array<MappedError> $secondErrors */
        $secondErrors = $secondAudit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
            validator: AuditOptions::VALIDATOR_SCHEMA_ORG,
            asObject: true,
        ));

        $this->assertNotEmpty($firstErrors);
        $this->assertCount(\count($firstErrors), $secondErrors);
        $this->assertSame(
            array_map(static fn (MappedError $error): string => $error->getMessage(), $firstErrors),
            array_map(static fn (MappedError $error): string => $error->getMessage(), $secondErrors),
        );
        $this->assertNotSame(
            array_map(static fn (MappedError $error): string => $error->getRanges(), $firstErrors),
            array_map(static fn (MappedError $error): string => $error->getRanges(), $secondErrors),
        );
    }

    public function testSwitchingValidatorModeDoesNotReuseWrongSnippetCache(): void
    {
        $validator = new Validator();
        $fixture = $this->benchmarkFixture('jolicampus-formations-symfony.html');

        $validator->setValidator(SchemaOrgValidator::class);
        $validator->audit($fixture);

        $validator->setValidator(GoogleValidator::class);
        $googleAudit = $validator->audit($fixture);

        $this->assertTrue($this->hasAtLeastOneGoogleDocumentationLink($googleAudit->getTypes()));
    }

    public function testDefaultValidatorModeHydratesGoogleDocumentationLinkForArrayTypes(): void
    {
        $validator = new Validator();
        $fixture = $this->benchmarkFixture('jolicampus-formations-symfony.html');

        $audit = $validator->audit($fixture);

        $this->assertTrue($this->hasAtLeastOneGoogleDocumentationLink($audit->getTypes()));
    }

    private function fixture(string $name): string
    {
        return __DIR__ . '/fixtures/extractor/' . $name;
    }

    private function benchmarkFixture(string $name): string
    {
        return __DIR__ . '/fixtures/benchmark/' . $name;
    }

    /**
     * @param array<MappedType> $types
     */
    private function hasAtLeastOneGoogleDocumentationLink(array $types): bool
    {
        foreach ($types as $type) {
            if (null !== $type->getGoogleLink()) {
                return true;
            }

            foreach ($type->getProperties() as $property) {
                $value = $property->getValue();

                if ($value instanceof MappedType && $this->hasAtLeastOneGoogleDocumentationLink([$value])) {
                    return true;
                }

                if (!\is_array($value)) {
                    continue;
                }

                foreach ($value as $entry) {
                    if ($entry instanceof MappedType && $this->hasAtLeastOneGoogleDocumentationLink([$entry])) {
                        return true;
                    }
                }
            }
        }

        return false;
    }
}
