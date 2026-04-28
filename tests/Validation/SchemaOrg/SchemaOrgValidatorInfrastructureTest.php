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

use Jolicode\Vocabularies\Mapper\MappedProperty;
use Jolicode\Vocabularies\Validator;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator
 *
 * @group validation
 * @group schemaorg
 */
class SchemaOrgValidatorInfrastructureTest extends TestCase
{
    private const PERFORMANCE_FIXTURE = __DIR__ . '/../fixtures/schema-org/complex-framed.jsonld';
    private const PERFORMANCE_TARGET_BYTES = 64000;
    private const PERFORMANCE_MAX_REPEATS = 12;
    private const PERFORMANCE_THRESHOLD_MS_LOCAL = 3000;
    private const PERFORMANCE_THRESHOLD_MS_CI = 5000;

    public function testGuessTypeFromPropertiesReturnsOfferForOfferSignals(): void
    {
        $validator = new SchemaOrgValidator();

        $guessedType = $validator->guessTypeFromProperties([
            new MappedProperty('price'),
            new MappedProperty('priceCurrency'),
        ]);

        $this->assertSame('Offer', $guessedType);
    }

    public function testGuessTypeFromPropertiesUsesParentPropertyHintWhenAvailable(): void
    {
        $validator = new SchemaOrgValidator();

        $guessedType = $validator->guessTypeFromProperties([
            new MappedProperty('addressLocality'),
            new MappedProperty('addressCountry'),
        ], 'birthPlace');

        $this->assertSame('Place', $guessedType);
    }

    public function testGuessTypeFromPropertiesFallsBackToThingWhenUnknownProperties(): void
    {
        $validator = new SchemaOrgValidator();

        $guessedType = $validator->guessTypeFromProperties([
            new MappedProperty('definitelyUnknownProperty'),
        ]);

        $this->assertSame('Thing', $guessedType);
    }

    public function testSchemaOrgFixtureBaselineDoesNotContainOrphanEntries(): void
    {
        $fixtureFiles = array_map(
            static fn (string $path): string => basename($path),
            glob(__DIR__ . '/../fixtures/schema-org/*.jsonld') ?: [],
        );

        $baseline = json_decode((string) file_get_contents(__DIR__ . '/../fixtures/schema-org-baseline.json'), true);
        $baselineKeys = array_keys($baseline ?: []);

        $orphanBaselineEntries = array_values(array_diff($baselineKeys, $fixtureFiles));

        $this->assertSame([], $orphanBaselineEntries, \sprintf(
            'Orphan entries in schema-org-baseline.json (no matching fixture file): %s',
            implode(', ', $orphanBaselineEntries),
        ));
    }

    public function testSchemaOrgExamplesBaselineDoesNotContainOrphanEntries(): void
    {
        $exampleFiles = array_map(
            static fn (string $path): string => basename($path),
            glob(__DIR__ . '/../../../resources/schema.org/examples/*.jsonld') ?: [],
        );

        $baseline = json_decode((string) file_get_contents(__DIR__ . '/../../../resources/schema.org/examples-baseline.json'), true);
        $baselineKeys = array_keys($baseline ?: []);

        $orphanBaselineEntries = array_values(array_diff($baselineKeys, $exampleFiles));

        $this->assertSame([], $orphanBaselineEntries, \sprintf(
            'Orphan entries in resources/schema.org/examples-baseline.json (no matching example file): %s',
            implode(', ', $orphanBaselineEntries),
        ));
    }

    public function testSchemaOrgValidationPerformanceSmokeOnLargeFixture(): void
    {
        $validator = new Validator();
        $validator->setValidator(SchemaOrgValidator::class);

        $largeDocument = $this->buildLargeDocumentFromFixture(self::PERFORMANCE_FIXTURE);

        $start = hrtime(true);
        $types = $validator->getTypes($largeDocument);
        $elapsedMs = (hrtime(true) - $start) / 1_000_000;
        $thresholdMs = $this->getPerformanceThresholdMs();

        $this->assertNotSame([], $types);
        $this->assertLessThan($thresholdMs, $elapsedMs, \sprintf(
            'Schema.org validation performance smoke test exceeded threshold (%.0f ms): %.2f ms',
            $thresholdMs,
            $elapsedMs,
        ));
    }

    private function getPerformanceThresholdMs(): int
    {
        return false !== getenv('CI') ? self::PERFORMANCE_THRESHOLD_MS_CI : self::PERFORMANCE_THRESHOLD_MS_LOCAL;
    }

    private function buildLargeDocumentFromFixture(string $fixturePath): string
    {
        $fixtureContent = file_get_contents($fixturePath);

        $this->assertNotFalse($fixtureContent, \sprintf('Could not read fixture file %s.', $fixturePath));

        $decoded = json_decode($fixtureContent, true);
        $this->assertIsArray($decoded, \sprintf('Fixture %s does not contain a valid JSON object/array.', $fixturePath));

        $bulkPayload = [];
        $repeats = 0;
        $encodedLength = 0;

        while ($encodedLength < self::PERFORMANCE_TARGET_BYTES && $repeats < self::PERFORMANCE_MAX_REPEATS) {
            if (array_is_list($decoded)) {
                $bulkPayload = [...$bulkPayload, ...$decoded];
            } else {
                $bulkPayload[] = $decoded;
            }

            ++$repeats;
            $encodedLength = \strlen((string) json_encode($bulkPayload, \JSON_UNESCAPED_SLASHES));
        }

        $largeDocument = json_encode($bulkPayload, \JSON_UNESCAPED_SLASHES);
        $this->assertNotFalse($largeDocument);

        return $largeDocument;
    }
}
