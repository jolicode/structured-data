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

use JoliCode\StructuredData\Mapper\MappedProperty;
use JoliCode\StructuredData\Mapper\MappedType;
use JoliCode\StructuredData\Validator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use JoliCode\StructuredData\Vocabularies\Validators\Google\SpecialRules\SpecialRulesRegistry;
use JoliCode\StructuredData\Vocabularies\Validators\Google\Stack;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[CoversClass(Stack::class)]
#[CoversClass(SpecialRulesRegistry::class)]
#[Group('validation')]
#[Group('google')]
class GoogleValidatorInfrastructureTest extends TestCase
{
    private const PERFORMANCE_FIXTURE = __DIR__ . '/../fixtures/google/book.jsonld';
    private const PERFORMANCE_TARGET_BYTES = 64000;
    private const PERFORMANCE_MAX_REPEATS = 12;
    private const PERFORMANCE_THRESHOLD_MS_LOCAL = 3000;
    private const PERFORMANCE_THRESHOLD_MS_CI = 5000;

    /**
     * @param array<string> $expectedSeverities
     */
    #[DataProvider('provideGoogleSpecialRuleContracts')]
    public function testGoogleSpecialRuleContract(string $ruleKey, array $expectedSeverities): void
    {
        $rulesByKey = SpecialRulesRegistry::allIndexed();
        $referencedKeys = $this->collectReferencedSpecialRuleKeys();

        $this->assertArrayHasKey($ruleKey, $rulesByKey, \sprintf('Rule key "%s" is not registered.', $ruleKey));
        $this->assertContains($ruleKey, $referencedKeys, \sprintf('Rule key "%s" is not referenced in resources/google/structured-data/*.json.', $ruleKey));

        $actualSeverities = $this->extractRuleSeveritiesFromSource($rulesByKey[$ruleKey]::class);

        sort($expectedSeverities);
        sort($actualSeverities);

        $this->assertSame($expectedSeverities, $actualSeverities, \sprintf(
            'Severity contract changed for rule "%s".',
            $ruleKey,
        ));
    }

    public function testStackResolvesProductSubtypeToSnippetWhenSnippetSignalsArePresent(): void
    {
        $type = new MappedType(sourceFormat: 'json-ld', type: 'Product', properties: [
            'name' => new MappedProperty('name'),
            'review' => new MappedProperty('review'),
        ]);

        $stack = (new Stack())->newType($type);

        $this->assertSame(
            'JoliCode\\StructuredData\\Vocabularies\\Generated\\Google\\ProductSnippet',
            $stack->getValidationClass(),
        );
    }

    public function testStackResolvesProductSubtypeToMerchantListingWhenMerchantSignalsArePresent(): void
    {
        $type = new MappedType(sourceFormat: 'json-ld', type: 'Product', properties: [
            'name' => new MappedProperty('name'),
            'image' => new MappedProperty('image'),
        ]);

        $stack = (new Stack())->newType($type);

        $this->assertSame(
            'JoliCode\\StructuredData\\Vocabularies\\Generated\\Google\\ProductMerchantListing',
            $stack->getValidationClass(),
        );
    }

    public function testAuditSurvivesAnUnexpectedNestedTypeWhereAnImportIsDeclared(): void
    {
        // Answer.comment declares supportedTypes ["@Comment"]: the property spec is
        // imported from the Comment validation class. A document nesting a type that
        // Comment does not support must still be audited, not crash the pipeline.
        $document = (string) json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'QAPage',
            'mainEntity' => [
                '@type' => 'Question',
                'name' => 'Is this audited?',
                'text' => 'Is this audited?',
                'answerCount' => 1,
                'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => 'Yes.',
                    'upvoteCount' => 1,
                    'comment' => ['@type' => 'Person', 'name' => 'Unexpected nested type'],
                ],
            ],
        ]);

        $validator = new Validator();
        $validator->setValidator(GoogleValidator::class);

        $audit = $validator->audit($document);

        $this->assertNotSame([], $audit->getTypes());
    }

    public function testAllReferencedGoogleSpecialRulesAreRegistered(): void
    {
        $registeredKeys = array_keys(SpecialRulesRegistry::allIndexed());
        $referencedKeys = $this->collectReferencedSpecialRuleKeys();

        $missingFromRegistry = array_values(array_diff($referencedKeys, $registeredKeys));

        $this->assertSame([], $missingFromRegistry, \sprintf(
            'Unknown rule keys referenced by resources/google/structured-data/*.json: %s',
            implode(', ', $missingFromRegistry),
        ));
    }

    public function testAllRegisteredGoogleSpecialRulesAreReferenced(): void
    {
        $registeredKeys = array_keys(SpecialRulesRegistry::allIndexed());
        $referencedKeys = $this->collectReferencedSpecialRuleKeys();

        $unusedRules = array_values(array_diff($registeredKeys, $referencedKeys));

        $this->assertSame([], $unusedRules, \sprintf(
            'Registered Google special rules not referenced by resources/google/structured-data/*.json: %s',
            implode(', ', $unusedRules),
        ));
    }

    public function testGoogleFixtureBaselineHasEntryForEachFixtureFile(): void
    {
        $fixtureFiles = array_merge(
            array_map(static fn (string $path): string => basename($path), glob(__DIR__ . '/../fixtures/google/*.jsonld') ?: []),
            array_map(static fn (string $path): string => basename($path), glob(__DIR__ . '/../fixtures/google/*.html') ?: []),
        );
        sort($fixtureFiles);

        $baseline = json_decode((string) file_get_contents(__DIR__ . '/../fixtures/google-baseline.json'), true);
        $baselineKeys = array_keys($baseline ?: []);
        sort($baselineKeys);

        $missingBaselineEntries = array_values(array_diff($fixtureFiles, $baselineKeys));

        $this->assertSame([], $missingBaselineEntries, \sprintf(
            'Google fixtures missing from google-baseline.json: %s',
            implode(', ', $missingBaselineEntries),
        ));
    }

    public function testGoogleFixtureBaselineDoesNotContainOrphanEntries(): void
    {
        $fixtureFiles = array_merge(
            array_map(static fn (string $path): string => basename($path), glob(__DIR__ . '/../fixtures/google/*.jsonld') ?: []),
            array_map(static fn (string $path): string => basename($path), glob(__DIR__ . '/../fixtures/google/*.html') ?: []),
        );

        $baseline = json_decode((string) file_get_contents(__DIR__ . '/../fixtures/google-baseline.json'), true);
        $baselineKeys = array_keys($baseline ?: []);

        $orphanBaselineEntries = array_values(array_diff($baselineKeys, $fixtureFiles));

        $this->assertSame([], $orphanBaselineEntries, \sprintf(
            'Orphan entries in google-baseline.json (no matching fixture file): %s',
            implode(', ', $orphanBaselineEntries),
        ));
    }

    public function testGoogleStructuredDataNamedPropertiesAllHaveSeverity(): void
    {
        $missingSeverityPaths = [];

        foreach (glob(__DIR__ . '/../../../resources/google/structured-data/*.json') ?: [] as $file) {
            $json = json_decode((string) file_get_contents($file), true);

            if (!\is_array($json)) {
                continue;
            }

            $this->collectMissingPropertySeverityPaths($json, basename($file), $missingSeverityPaths);
        }

        $this->assertSame([], $missingSeverityPaths, \sprintf(
            'Named Google properties without severity in resources/google/structured-data/*.json: %s',
            implode(', ', $missingSeverityPaths),
        ));
    }

    public function testGoogleValidationPerformanceSmokeOnLargeFixture(): void
    {
        $validator = new Validator();
        $validator->setValidator(GoogleValidator::class);

        $largeDocument = $this->buildLargeDocumentFromFixture(self::PERFORMANCE_FIXTURE);

        $start = hrtime(true);
        $audit = $validator->audit($largeDocument);
        $elapsedMs = (hrtime(true) - $start) / 1_000_000;
        $thresholdMs = $this->getPerformanceThresholdMs();

        $this->assertNotSame([], $audit->getTypes());
        $this->assertLessThan($thresholdMs, $elapsedMs, \sprintf(
            'Google validation performance smoke test exceeded threshold (%.0f ms): %.2f ms',
            $thresholdMs,
            $elapsedMs,
        ));
    }

    /**
     * @return \Generator<string, array{string, array<string>}>
     */
    public static function provideGoogleSpecialRuleContracts(): \Generator
    {
        yield 'article-author-url-or-sameas' => ['google.article.author_url_or_sameas', []];
        yield 'book-offer-pricing-by-category' => ['google.book.offer_pricing_by_category', ['error']];
        yield 'breadcrumb-last-item-optional' => ['google.breadcrumb.last_item_optional', ['error']];
        yield 'discussion-forum-content-or-url' => ['google.discussion_forum.content_or_url', []];
        yield 'job-posting-remote-job-location-requirements' => ['google.job_posting.remote_job_location_requirements', ['error']];
        yield 'organization-return-policy-merchant-return-days-when-finite' => ['google.organization.return_policy_merchant_return_days_when_finite', ['error']];
        yield 'organization-tax-id-country-consistency' => ['google.organization.tax_id_country_consistency', ['warning']];
        yield 'product-merchant-listing-price-positive' => ['google.product.merchant_listing_price_positive', ['error']];
        yield 'qapage-answer-comment-count-consistency' => ['google.qapage.answer_comment_count_consistency', ['warning']];
        yield 'recipe-calories-requires-yield' => ['google.recipe.calories_requires_yield', ['warning']];
        yield 'speakable-cssselector-or-xpath' => ['google.speakable.cssselector_or_xpath', ['error']];
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

    /**
     * @return array<string>
     */
    private function collectReferencedSpecialRuleKeys(): array
    {
        $keys = [];

        foreach (glob(__DIR__ . '/../../../resources/google/structured-data/*.json') ?: [] as $file) {
            $json = json_decode((string) file_get_contents($file), true);

            if (\is_array($json)) {
                $this->collectSpecialRuleKeysRecursively($json, $keys);
            }
        }

        $keys = array_values(array_unique($keys));
        sort($keys);

        return $keys;
    }

    /**
     * @param array<mixed>  $node
     * @param array<string> $keys
     */
    private function collectSpecialRuleKeysRecursively(array $node, array &$keys): void
    {
        if (isset($node['specialRules']) && \is_array($node['specialRules'])) {
            foreach ($node['specialRules'] as $key) {
                if (\is_string($key)) {
                    $keys[] = $key;
                }
            }
        }

        foreach ($node as $value) {
            if (\is_array($value)) {
                $this->collectSpecialRuleKeysRecursively($value, $keys);
            }
        }
    }

    /**
     * @param array<mixed>  $node
     * @param array<string> $missingSeverityPaths
     */
    private function collectMissingPropertySeverityPaths(array $node, string $path, array &$missingSeverityPaths): void
    {
        if (isset($node['properties']) && \is_array($node['properties'])) {
            foreach ($node['properties'] as $propertyKey => $propertyDefinition) {
                if (!\is_array($propertyDefinition) || isset($propertyDefinition['@target'])) {
                    continue;
                }

                if (isset($propertyDefinition['name']) && \is_string($propertyDefinition['name']) && !\array_key_exists('severity', $propertyDefinition)) {
                    $missingSeverityPaths[] = \sprintf('%s:%s', $path, $propertyKey);
                }

                $this->collectMissingPropertySeverityPaths(
                    $propertyDefinition,
                    $path . '.' . (\is_string($propertyKey) ? $propertyKey : (string) $propertyKey),
                    $missingSeverityPaths,
                );
            }
        }

        foreach ($node as $key => $value) {
            if ('properties' === $key || !\is_array($value)) {
                continue;
            }

            $this->collectMissingPropertySeverityPaths(
                $value,
                $path . '.' . (\is_string($key) ? $key : (string) $key),
                $missingSeverityPaths,
            );
        }
    }

    /**
     * @return array<string>
     */
    private function extractRuleSeveritiesFromSource(string $ruleClass): array
    {
        $reflection = new \ReflectionClass($ruleClass);
        $source = file_get_contents($reflection->getFileName());

        if (false === $source) {
            return [];
        }

        preg_match_all('/MappedError::SEVERITY_(ERROR|WARNING)/', $source, $matches);

        $severities = array_map('strtolower', $matches[1] ?? []);

        return array_values(array_unique($severities));
    }
}
