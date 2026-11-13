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
use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Mapper\MappedTypeMerger;
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use PHPUnit\Framework\TestCase;

/**
 * The blocks of a document sharing an identifier describe one node for Google:
 * a property one block omits is not missing when another block provides it.
 */
class SharedIdentifierTest extends TestCase
{
    private const FIXTURE = __DIR__ . '/fixtures/google/event-two-blocks-same-id.html';

    public function testAPropertyProvidedByAnotherBlockIsNotMissing(): void
    {
        $validator = new Validator();
        $validator->setValidator(GoogleValidator::class);

        $audit = $validator->audit((string) file_get_contents(self::FIXTURE));

        $this->assertTrue($audit->isValid());
        $this->assertSame([], $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_ERROR)));

        // What no block provides is still reported, by each block.
        /** @var list<string> $warnings */
        $warnings = $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_WARNING));
        $this->assertCount(8, $warnings);
        $this->assertCount(2, array_filter($warnings, static fn (string $message): bool => str_contains($message, '"offers"')));
        $this->assertSame([], array_filter($warnings, static fn (string $message): bool => str_contains($message, '"image"') || str_contains($message, '"description"')));

        // The withdrawn errors no longer weigh on the blocks' severity.
        foreach ($audit->getTypes() as $type) {
            $this->assertSame('warning', $type->getErrorSeverity());
        }
    }

    public function testTheReconciliationSurvivesTheSnippetCache(): void
    {
        $validator = new Validator();
        $validator->setValidator(GoogleValidator::class);
        $document = (string) file_get_contents(self::FIXTURE);

        /** @var list<string> $first */
        $first = $validator->audit($document)->getDiagnostic();
        /** @var list<string> $second */
        $second = $validator->audit($document)->getDiagnostic();

        $this->assertCount(8, $first);
        $this->assertSame($first, $second);
    }

    public function testDisagreeingValuesAreReportedAsADocumentWarningOnly(): void
    {
        $validator = new Validator();
        $validator->setValidator(GoogleValidator::class);

        $audit = $validator->audit((string) file_get_contents(__DIR__ . '/fixtures/google/event-two-blocks-same-id-conflicting-values.html'));

        $this->assertTrue($audit->isValid());

        /** @var list<string> $documentIssues */
        $documentIssues = $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_DOCUMENT));
        $this->assertCount(2, $documentIssues);
        $this->assertStringContainsString('The "description" of "https://example.com/events/symfonylive-2026" has a different value in each of the 2 blocks', $documentIssues[0]);
        $this->assertStringContainsString('"startDate"', $documentIssues[1]);

        // Google reports nothing about it: the Google diagnostics stay the same.
        /** @var list<string> $googleMessages */
        $googleMessages = $audit->getDiagnostic(new AuditOptions(validator: AuditOptions::VALIDATOR_GOOGLE));
        $this->assertSame([], array_filter($googleMessages, static fn (string $message): bool => str_contains($message, 'different value')));
    }

    public function testBlocksWithDifferentOrBlankIdentifiersAreNotMerged(): void
    {
        $validator = new Validator();
        $validator->setValidator(GoogleValidator::class);

        $document = <<<'HTML'
<script type="application/ld+json">
{"@context": "https://schema.org", "@type": "Event", "@id": "_:b0", "name": "A", "location": {"@type": "Place", "name": "Paris", "address": "Somewhere"}}
</script>
<script type="application/ld+json">
{"@context": "https://schema.org", "@type": "Event", "@id": "_:b0", "name": "A", "startDate": "2026-03-26", "endDate": "2026-03-27"}
</script>
HTML;

        $audit = $validator->audit($document);

        $this->assertFalse($audit->isValid());
        /** @var list<string> $errors */
        $errors = $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_ERROR));
        $this->assertCount(3, $errors);
    }

    public function testGroupingIgnoresTypesWithoutAnAbsoluteIdentifier(): void
    {
        $withId = static function (string $id): MappedType {
            $type = new MappedType(sourceFormat: 'json-ld', type: 'Event');
            $property = new MappedProperty('@id', $type);
            $property->setValue($id);
            $type->setProperty('@id', $property);

            return $type;
        };

        $groups = MappedTypeMerger::groupByIdentifier([
            $withId('https://example.com/a'),
            $withId('https://example.com/a'),
            $withId('https://example.com/b'),
            $withId('_:b0'),
            $withId('_:b0'),
            $withId('relative/path'),
            $withId('relative/path'),
            new MappedType(sourceFormat: 'json-ld', type: 'Event'),
        ]);

        $this->assertSame(['https://example.com/a'], array_keys($groups));
        $this->assertCount(2, $groups['https://example.com/a']);
    }
}
