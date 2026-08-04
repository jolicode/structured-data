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
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('validation')]
#[Group('schemaorg')]
#[Group('schema-org')]
class SchemaOrgValidatorMicrodataTest extends TestCase
{
    public function testValidatorParsesMicrodataDocument(): void
    {
        $validator = new Validator();
        $validator->setValidator(SchemaOrgValidator::class);

        $audit = $validator->audit($this->fixture('microdata-person-valid.html'));
        $types = $audit->getTypes();

        $this->assertNotSame([], $types);
        $this->assertSame([], $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        )));

        $firstType = $types[0];
        $firstTypeLabel = $firstType->getType();
        $this->assertSame('Person', \is_array($firstTypeLabel) ? $firstTypeLabel[0] : $firstTypeLabel);
    }

    public function testValidatorAcceptsMicrodataDocumentWithMultipleItemTypes(): void
    {
        $validator = new Validator();
        $validator->setValidator(SchemaOrgValidator::class);

        $audit = $validator->audit($this->fixture('microdata-item-list-creative-work.html'));
        $types = $audit->getTypes();

        $this->assertNotSame([], $types);
        $this->assertSame([], $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        )));

        $firstType = $types[0];
        $this->assertSame(['ItemList', 'CreativeWork'], $firstType->getType());
    }

    public function testValidatorReturnsErrorForInvalidMicrodataDocument(): void
    {
        $validator = new Validator();
        $validator->setValidator(SchemaOrgValidator::class);

        $audit = $validator->audit($this->fixture('microdata-invalid-missing-itemtype.html'));
        $types = $audit->getTypes();

        $this->assertCount(0, $types);
        $this->assertFalse($audit->isValid());

        /** @var array<string> $messages */
        $messages = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        ));
        $this->assertStringContainsString('Invalid microdata document', $messages[0]);
    }

    public function testValidatorPrioritizesJsonLdWhenJsonLdAndMicrodataAreBothPresent(): void
    {
        $validator = new Validator();
        $validator->setValidator(SchemaOrgValidator::class);

        $audit = $validator->audit($this->fixture('microdata-mixed-valid-jsonld-invalid-microdata.html'));
        $types = $audit->getTypes();

        $this->assertNotSame([], $types);
        $this->assertSame([], $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        )));
    }

    private function fixture(string $name): string
    {
        $content = file_get_contents(__DIR__ . '/../fixtures/schema-org/' . $name);

        $this->assertNotFalse($content);

        return $content;
    }
}
