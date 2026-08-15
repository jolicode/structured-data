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
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use JoliCode\StructuredData\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;
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

    public function testRepeatedSnippetValidationKeepsErrorDocumentationLinks(): void
    {
        $validator = new Validator();
        $validator->setValidator(GoogleValidator::class);

        $snippet = file_get_contents(__DIR__ . '/fixtures/google/article-author-missing-url-and-sameas.jsonld');
        $this->assertNotFalse($snippet);

        $firstAudit = $validator->audit("<html>\n<script type=\"application/ld+json\">{$snippet}</script>\n</html>");
        $secondAudit = $validator->audit("<html>\n\n\n<script type=\"application/ld+json\">{$snippet}</script>\n</html>");

        /** @var array<MappedError> $firstWarnings */
        $firstWarnings = $firstAudit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
            asObject: true,
        ));

        /** @var array<MappedError> $secondWarnings */
        $secondWarnings = $secondAudit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
            asObject: true,
        ));

        $firstLinks = array_map(static fn (MappedError $error): ?string => $error->getDocumentationLink(), $firstWarnings);

        $this->assertNotEmpty($firstWarnings);
        $this->assertContains('https://developers.google.com/search/docs/appearance/structured-data/article#article-objects', $firstLinks);
        $this->assertSame(
            $firstLinks,
            array_map(static fn (MappedError $error): ?string => $error->getDocumentationLink(), $secondWarnings),
        );
    }

    public function testSwitchingValidatorModeDoesNotReuseWrongSnippetCache(): void
    {
        $validator = new Validator();
        $fixture = $this->benchmarkFixture('array-types-with-google-support.html');

        $validator->setValidator(SchemaOrgValidator::class);
        $validator->audit($fixture);

        $validator->setValidator(GoogleValidator::class);
        $googleAudit = $validator->audit($fixture);

        $this->assertTrue($this->hasAtLeastOneGoogleDocumentationLink($googleAudit->getTypes()));
    }

    public function testDefaultValidatorModeHydratesGoogleDocumentationLinkForArrayTypes(): void
    {
        $validator = new Validator();
        $fixture = $this->benchmarkFixture('array-types-with-google-support.html');

        $audit = $validator->audit($fixture);

        $this->assertTrue($this->hasAtLeastOneGoogleDocumentationLink($audit->getTypes()));
    }

    private function fixture(string $name): string
    {
        return $this->read(__DIR__ . '/fixtures/extractor/' . $name);
    }

    private function benchmarkFixture(string $name): string
    {
        return $this->read(__DIR__ . '/fixtures/benchmark/' . $name);
    }

    private function read(string $path): string
    {
        $content = file_get_contents($path);

        if (false === $content) {
            throw new \RuntimeException(\sprintf('The fixture "%s" could not be read.', $path));
        }

        return $content;
    }

    /**
     * @param array<MappedType> $types
     */
    private function hasAtLeastOneGoogleDocumentationLink(array $types): bool
    {
        foreach ($types as $type) {
            if (null !== $type->getDocumentationLink()) {
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
