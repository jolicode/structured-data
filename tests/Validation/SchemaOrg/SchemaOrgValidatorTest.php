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

use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;

/**
 * @covers \Jolicode\Vocabularies\JsonLdValidator
 * @covers \Jolicode\Vocabularies\Validators\SchemaOrgValidator
 *
 * @group validation
 * @group schemaorg
 */
class SchemaOrgValidatorTest extends AbstractValidatorTestCase
{
    /**
     * @dataProvider provideSchemaOrgFiles
     */
    public function testSchemaOrgValidator(string $filePath, bool $isValid, array $expectedMessages): void
    {
        $this->assertValidationResultMatchesExpectations($filePath, $isValid, $expectedMessages, SchemaOrgValidator::class);
    }

    public function testSchemaOrgValidatorAcceptsMixedCaseTypeAndPropertyKeys(): void
    {
        $document = file_get_contents(__DIR__ . '/../fixtures/schema-org/simple-compacted.jsonld');
        $this->assertNotFalse($document);

        $document = str_replace('"@type": "Person"', '"@type": "pErSoN"', $document);
        $document = str_replace('"name": "Jane Doe"', '"Name": "Jane Doe"', $document);

        $this->assertDocumentIsValidForValidator($document, SchemaOrgValidator::class);
    }

    /**
     * @dataProvider provideSchemaOrgExamples
     */
    public function testSchemaOrgExamples(string $filePath, bool $isValid = true, array $expectedErrors = []): void
    {
        $this->assertValidationResultMatchesExpectations($filePath, $isValid, $expectedErrors, SchemaOrgValidator::class);
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
