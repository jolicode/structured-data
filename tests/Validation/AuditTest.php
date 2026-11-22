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

use JoliCode\StructuredData\Audit\Audit;
use JoliCode\StructuredData\Audit\AuditOptions;
use JoliCode\StructuredData\Mapper\MappedError;
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Mapper\MappedTypeMerger;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use JoliCode\StructuredData\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('validation')]
class AuditTest extends TestCase
{
    public function testWithoutOptionsTheDiagnosticIsTheListOfEveryFormattedMessage(): void
    {
        $this->assertSame(
            [
                '[Google error] Recipe: google error',
                '[Google warning] Recipe: google warning',
                '[SchemaOrg warning] Recipe: schema.org warning',
                '[Merge warning] Recipe: merge warning',
                '[Document error] document error',
            ],
            $this->createAudit()->getDiagnostic(),
        );
    }

    /**
     * @param list<string> $expectedMessages
     */
    #[DataProvider('provideFilters')]
    public function testTheDiagnosticIsFilteredBySeverityOrValidator(AuditOptions $options, array $expectedMessages): void
    {
        $errors = $this->createAudit()->getDiagnostic($options);

        $this->assertIsArray($errors);
        $this->assertSame($expectedMessages, array_map(
            static fn (mixed $error): string => $error instanceof MappedError ? $error->getMessage() : '',
            $errors,
        ));
    }

    /**
     * @return iterable<string, array{AuditOptions, list<string>}>
     */
    public static function provideFilters(): iterable
    {
        yield 'errors' => [
            new AuditOptions(severity: AuditOptions::SEVERITY_ERROR, asObject: true),
            ['google error', 'document error'],
        ];
        yield 'warnings' => [
            new AuditOptions(severity: AuditOptions::SEVERITY_WARNING, asObject: true),
            ['google warning', 'schema.org warning', 'merge warning'],
        ];
        yield 'document severity' => [
            new AuditOptions(severity: AuditOptions::SEVERITY_DOCUMENT, asObject: true),
            ['document error'],
        ];
        yield 'google' => [
            new AuditOptions(validator: AuditOptions::VALIDATOR_GOOGLE, asObject: true),
            ['google error', 'google warning'],
        ];
        yield 'schema.org' => [
            new AuditOptions(validator: AuditOptions::VALIDATOR_SCHEMA_ORG, asObject: true),
            ['schema.org warning'],
        ];
        yield 'document validator' => [
            new AuditOptions(validator: AuditOptions::VALIDATOR_DOCUMENT, asObject: true),
            ['document error'],
        ];
        yield 'merge' => [
            new AuditOptions(validator: AuditOptions::VALIDATOR_MERGE, asObject: true),
            ['merge warning'],
        ];
    }

    public function testTheMessagesAreGroupedByValidator(): void
    {
        $this->assertSame(
            [
                'Google' => ['[Google error] Recipe: google error', '[Google warning] Recipe: google warning'],
                'SchemaOrg' => ['[SchemaOrg warning] Recipe: schema.org warning'],
                'Merge' => ['[Merge warning] Recipe: merge warning'],
                'Document' => ['[Document error] document error'],
            ],
            $this->createAudit()->getDiagnostic(new AuditOptions(groupBy: AuditOptions::GROUP_BY_VALIDATOR)),
        );
    }

    public function testTheErrorObjectsAreGroupedBySeverity(): void
    {
        $groups = $this->createAudit()->getDiagnostic(new AuditOptions(groupBy: AuditOptions::GROUP_BY_SEVERITY, asObject: true));

        $this->assertIsArray($groups);
        $this->assertSame(['error', 'warning'], array_keys($groups));
        $this->assertIsArray($groups['error']);
        $this->assertIsArray($groups['warning']);
        $this->assertContainsOnlyInstancesOf(MappedError::class, $groups['error']);
        $this->assertCount(2, $groups['error']);
        $this->assertCount(3, $groups['warning']);
    }

    public function testTheDiagnosticCanBeEncodedAsJson(): void
    {
        $json = $this->createAudit()->getDiagnostic(new AuditOptions(
            validator: AuditOptions::VALIDATOR_SCHEMA_ORG,
            asObject: true,
            jsonEncode: true,
        ));

        $this->assertIsString($json);
        $this->assertSame(
            [
                [
                    'message' => 'schema.org warning',
                    'property' => 'name',
                    'type' => 'Recipe',
                    'severity' => 'warning',
                    'validatorName' => 'SchemaOrg',
                    'ranges' => '1:2 to 1:8',
                    'path' => 'Recipe',
                    'documentationLink' => 'https://schema.org/Recipe',
                ],
            ],
            json_decode($json, true, flags: \JSON_THROW_ON_ERROR),
        );
    }

    public function testAnUnknownSeverityIsRefused(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid severity query option provided: fatal');

        $this->createAudit()->getDiagnostic(new AuditOptions(severity: 'fatal'));
    }

    public function testAnUnknownValidatorIsRefused(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid validator query option provided: bing');

        $this->createAudit()->getDiagnostic(new AuditOptions(validator: 'bing'));
    }

    public function testAWarningKeepsTheAuditValidButNotFullyValid(): void
    {
        $type = new MappedType(sourceFormat: 'json-ld', type: 'Recipe');
        $audit = new Audit([$type]);

        $this->assertTrue($audit->isValid());
        $this->assertTrue($audit->isFullyValid());

        $type->addError($this->error('only a warning', MappedError::SEVERITY_WARNING, GoogleValidator::VALIDATOR_NAME, $type));
        $audit = new Audit([$type]);

        $this->assertTrue($audit->isValid());
        $this->assertFalse($audit->isFullyValid());

        $this->assertFalse($this->createAudit()->isValid());
        $this->assertFalse($this->createAudit()->isFullyValid());
    }

    public function testThePathOfAnErrorFallsBackFromItsParentToItsPropertyThenItsType(): void
    {
        $type = new MappedType(sourceFormat: 'json-ld', type: 'Recipe');
        $property = new MappedProperty('name', $type);

        $onProperty = new MappedError('message', 'name', 'Recipe', MappedError::SEVERITY_ERROR, 'Google', '', $property);

        $this->assertSame($property, $onProperty->getParent());
        $this->assertSame($property->getPath(), $onProperty->getPath());
        $this->assertSame('name', (new MappedError('message', 'name', 'Recipe', MappedError::SEVERITY_ERROR, 'Google', ''))->getPath());
        $this->assertSame('Recipe', (new MappedError('message', null, 'Recipe', MappedError::SEVERITY_ERROR, 'Google', ''))->getPath());
        $this->assertSame('', (new MappedError('message', null, null, MappedError::SEVERITY_ERROR, 'Google', ''))->getPath());
    }

    private function createAudit(): Audit
    {
        $type = new MappedType(sourceFormat: 'json-ld', type: 'Recipe');
        $type->addError($this->error('google error', MappedError::SEVERITY_ERROR, GoogleValidator::VALIDATOR_NAME, $type));
        $type->addError($this->error('google warning', MappedError::SEVERITY_WARNING, GoogleValidator::VALIDATOR_NAME, $type));
        $type->addError($this->error('schema.org warning', MappedError::SEVERITY_WARNING, SchemaOrgValidator::VALIDATOR_NAME, $type));
        $type->addError($this->error('merge warning', MappedError::SEVERITY_WARNING, MappedTypeMerger::VALIDATOR_NAME, $type));

        return new Audit([$type], [$this->error('document error', MappedError::SEVERITY_ERROR, 'Document')]);
    }

    private function error(string $message, string $severity, string $validatorName, ?MappedType $parent = null): MappedError
    {
        return new MappedError(
            message: $message,
            property: $parent ? 'name' : null,
            type: $parent ? 'Recipe' : null,
            severity: $severity,
            validatorName: $validatorName,
            ranges: '1:2 to 1:8',
            parent: $parent,
            documentationLink: 'https://schema.org/Recipe',
        );
    }
}
