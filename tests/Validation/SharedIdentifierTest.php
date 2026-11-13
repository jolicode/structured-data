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
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use PHPUnit\Framework\TestCase;

/**
 * The blocks of a document sharing an identifier describe one node for Google:
 * by default, they make one item of the audit, validated as a whole, and a
 * property one block omits is not missing when another block provides it.
 */
class SharedIdentifierTest extends TestCase
{
    private const FIXTURE = __DIR__ . '/fixtures/google/event-two-blocks-same-id.html';
    private const CONFLICTING_FIXTURE = __DIR__ . '/fixtures/google/event-two-blocks-same-id-conflicting-values.html';
    private const IDENTIFIER = 'https://example.com/events/symfonylive-2026';

    public function testTheBlocksSharingAnIdentifierMakeOneItem(): void
    {
        $audit = $this->audit(self::FIXTURE);

        $this->assertCount(2, $audit->getTypes());
        $this->assertCount(1, $audit->getItems());

        $item = $audit->getItems()[0];
        $this->assertTrue($item->isMerged());
        $this->assertSame(self::IDENTIFIER, $item->getIdentifier());
        $this->assertSame($audit->getTypes(), $item->getSources());
        $this->assertSame(['jsonld', 'microdata'], array_map(static fn (MappedType $source): string => $source->getSourceFormat(), $item->getSources()));

        // The merged node holds the union of the properties.
        foreach (['name', 'description', 'location', 'startDate', 'endDate', 'image'] as $key) {
            $this->assertTrue($item->getType()->hasProperty($key), \sprintf('The merged node lacks "%s".', $key));
        }
    }

    public function testAPropertyProvidedByAnotherBlockIsNotMissing(): void
    {
        $audit = $this->audit(self::FIXTURE);

        $this->assertTrue($audit->isValid());
        $this->assertSame([], $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_ERROR)));

        // What no block provides is reported once, for the node, with the
        // positions of both blocks.
        /** @var list<MappedError> $warnings */
        $warnings = $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_WARNING, asObject: true));
        $this->assertCount(4, $warnings);
        $this->assertCount(1, array_filter($warnings, static fn (MappedError $warning): bool => str_contains($warning->getMessage(), '"offers"')));
        $this->assertSame([], array_filter($warnings, static fn (MappedError $warning): bool => str_contains($warning->getMessage(), '"image"') || str_contains($warning->getMessage(), '"description"')));
        $this->assertCount(2, explode(\PHP_EOL, $warnings[0]->getRanges()));
    }

    public function testTheSourcesKeepTheirOwnAudit(): void
    {
        $sources = $this->audit(self::FIXTURE)->getItems()[0]->getSources();

        // Alone, the JSON-LD block lacks its dates and the microdata one its location.
        $this->assertSame('error', $sources[0]->getErrorSeverity());
        $this->assertSame(['startDate', 'endDate'], $this->missingRequiredProperties($sources[0]));
        $this->assertSame(['location'], $this->missingRequiredProperties($sources[1]));
    }

    public function testDisablingTheMergeAuditsEveryBlockOnItsOwn(): void
    {
        $audit = $this->audit(self::FIXTURE, merge: false);

        $this->assertCount(2, $audit->getItems());

        foreach ($audit->getItems() as $index => $item) {
            $this->assertFalse($item->isMerged());
            $this->assertSame(self::IDENTIFIER, $item->getIdentifier());
            $this->assertSame([$audit->getTypes()[$index]], $item->getSources());
            $this->assertSame($audit->getTypes()[$index], $item->getType());
        }

        $this->assertFalse($audit->isValid());
        $this->assertCount(3, (array) $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_ERROR)));
        $this->assertCount(10, (array) $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_WARNING)));

        // No merged node, so no disagreement to report either.
        $conflicting = $this->audit(self::CONFLICTING_FIXTURE, merge: false);
        $this->assertSame([], $conflicting->getDiagnostic(new AuditOptions(validator: AuditOptions::VALIDATOR_MERGE)));
        $this->assertSame([], $conflicting->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_DOCUMENT)));
    }

    public function testTheMergeSurvivesTheSnippetCache(): void
    {
        $validator = $this->createValidator();
        $document = (string) file_get_contents(self::CONFLICTING_FIXTURE);

        $first = $validator->audit($document);
        $second = $validator->audit($document);

        $this->assertCount(6, (array) $first->getDiagnostic());
        $this->assertSame($first->getDiagnostic(), $second->getDiagnostic());
        $this->assertNotSame($first->getItems()[0]->getType(), $second->getItems()[0]->getType());
    }

    public function testOneValidatorCanAlternateBetweenBothModes(): void
    {
        $merged = $this->diagnose($this->createValidator(), self::FIXTURE, true);
        $unmerged = $this->diagnose($this->createValidator(), self::FIXTURE, false);
        $this->assertNotSame($merged, $unmerged);

        $worker = $this->createValidator();

        foreach ([true, false, true, false, true] as $round => $merge) {
            $this->assertSame(
                $merge ? $merged : $unmerged,
                $this->diagnose($worker, self::FIXTURE, $merge),
                \sprintf('Round %d (%s) drifted from a fresh validator.', $round, $merge ? 'merged' : 'unmerged'),
            );
        }
    }

    public function testDisagreeingValuesAreAWarningOfTheMergedItem(): void
    {
        $audit = $this->audit(self::CONFLICTING_FIXTURE);

        $this->assertTrue($audit->isValid());
        $this->assertSame([], $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_DOCUMENT)));

        /** @var list<MappedError> $conflicts */
        $conflicts = $audit->getDiagnostic(new AuditOptions(validator: AuditOptions::VALIDATOR_MERGE, asObject: true));
        $this->assertCount(2, $conflicts);
        $this->assertSame(['description', 'startDate'], array_map(static fn (MappedError $conflict): ?string => $conflict->getProperty(), $conflicts));
        $this->assertSame(MappedError::SEVERITY_WARNING, $conflicts[0]->getSeverity());
        $this->assertStringContainsString('The 2 blocks describing "' . self::IDENTIFIER . '" give it different values ("Two days of talks about the Symfony framework.", "Another description")', $conflicts[0]->getMessage());
        $this->assertCount(2, explode(\PHP_EOL, $conflicts[0]->getRanges()));

        // The warnings belong to the merged node, not to the blocks.
        $this->assertContains($conflicts[0], $audit->getItems()[0]->getType()->getMergedErrors());

        foreach ($audit->getTypes() as $source) {
            $this->assertNotContains($conflicts[0], $source->getMergedErrors());
        }

        // Google reports nothing about it: the Google diagnostics stay the same.
        /** @var list<string> $googleMessages */
        $googleMessages = $audit->getDiagnostic(new AuditOptions(validator: AuditOptions::VALIDATOR_GOOGLE));
        $this->assertSame([], array_filter($googleMessages, static fn (string $message): bool => str_contains($message, 'different values')));
    }

    public function testBlocksWithDifferentOrBlankIdentifiersAreNotMerged(): void
    {
        $document = <<<'HTML'
<script type="application/ld+json">
{"@context": "https://schema.org", "@type": "Event", "@id": "_:b0", "name": "A", "location": {"@type": "Place", "name": "Paris", "address": "Somewhere"}}
</script>
<script type="application/ld+json">
{"@context": "https://schema.org", "@type": "Event", "@id": "_:b0", "name": "A", "startDate": "2026-03-26", "endDate": "2026-03-27"}
</script>
<script type="application/ld+json">
{"@context": "https://schema.org", "@type": "Event", "@id": "https://example.com/other", "name": "B", "startDate": "2026-03-26", "endDate": "2026-03-27", "location": {"@type": "Place", "name": "Paris", "address": "Somewhere"}}
</script>
HTML;

        $validator = $this->createValidator();
        $audit = $validator->audit($document);

        $this->assertCount(3, $audit->getItems());
        $this->assertSame([null, null, 'https://example.com/other'], array_map(static fn ($item): ?string => $item->getIdentifier(), $audit->getItems()));
        $this->assertFalse($audit->isValid());
        $this->assertCount(3, (array) $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_ERROR)));
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

    private function createValidator(): Validator
    {
        $validator = new Validator();
        $validator->setValidator(GoogleValidator::class);

        return $validator;
    }

    private function audit(string $fixture, bool $merge = true): Audit
    {
        return $this->createValidator()->audit((string) file_get_contents($fixture), mergeNodesSharingAnIdentifier: $merge);
    }

    /**
     * @return array{bool, int, array<string>}
     */
    private function diagnose(Validator $validator, string $fixture, bool $merge): array
    {
        $audit = $validator->audit((string) file_get_contents($fixture), mergeNodesSharingAnIdentifier: $merge);

        /** @var array<string> $messages */
        $messages = $audit->getDiagnostic();

        return [$audit->isValid(), \count($audit->getItems()), $messages];
    }

    /**
     * @return list<string>
     */
    private function missingRequiredProperties(MappedType $type): array
    {
        $missing = [];

        foreach ($type->getMergedErrors() as $error) {
            if (MappedError::SEVERITY_ERROR === $error->getSeverity() && preg_match('/^Missing required property: "([^"]+)"/', $error->getMessage(), $matches)) {
                $missing[] = $matches[1];
            }
        }

        return $missing;
    }
}
