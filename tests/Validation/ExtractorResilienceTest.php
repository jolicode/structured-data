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
use Jolicode\JsonLd\Extraction\Extractor;
use Jolicode\JsonLd\Validator;
use PHPUnit\Framework\TestCase;

/**
 * @group validation
 */
class ExtractorResilienceTest extends TestCase
{
    public function testItExtractsASingleValidJsonLdFromARegularWebPage(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('jsonld-valid-single.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('Single JsonLd', $elements[0]->content);
    }

    public function testItExtractsMultipleValidJsonLdElementsFromARegularWebPage(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('jsonld-valid-multiple.html'));

        $this->assertCount(2, $elements);
        $this->assertStringContainsString('Json One', $elements[0]->content);
        $this->assertStringContainsString('Json Two', $elements[1]->content);
    }

    public function testItRaisesAnExplicitExceptionForASingleInvalidJsonLdElementInARegularWebPage(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid JSON-LD document');

        $this->createExtractor()->extract($this->fixture('jsonld-invalid-single.html'));
    }

    public function testItRaisesAnExplicitExceptionForMultipleInvalidJsonLdElementsInARegularWebPage(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid JSON-LD document');

        $this->createExtractor()->extract($this->fixture('jsonld-invalid-multiple.html'));
    }

    public function testItExtractsASingleValidMicrodataFromARegularWebPage(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('microdata-valid-single.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"@type":"Person"', $elements[0]->content);
        $this->assertStringContainsString('"name":"Single Microdata"', $elements[0]->content);
    }

    public function testItPreservesMultipleMicrodataItemTypes(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('microdata-valid-multiple-itemtypes.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"@type":["ItemList","CreativeWork"]', $elements[0]->content);
    }

    public function testItExtractsMultipleValidMicrodataElementsFromARegularWebPage(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('microdata-valid-multiple.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"name":"Micro Org"', $elements[0]->content);
        $this->assertStringContainsString('"name":"Micro Person"', $elements[0]->content);
    }

    public function testItRaisesAnExplicitExceptionForASingleInvalidMicrodataElementInARegularWebPage(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid microdata document');

        $this->createExtractor()->extract($this->fixture('microdata-invalid-single.html'));
    }

    public function testItRaisesAnExplicitExceptionForMultipleInvalidMicrodataElementsInARegularWebPage(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid microdata document');

        $this->createExtractor()->extract($this->fixture('microdata-invalid-multiple.html'));
    }

    public function testItExtractsASingleValidRdfaFromARegularWebPage(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('rdfa-valid-single.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"@type":"Person"', $elements[0]->content);
        $this->assertStringContainsString('"name":"Single RDFa"', $elements[0]->content);
    }

    public function testItExtractsMultipleValidRdfaElementsFromARegularWebPage(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('rdfa-valid-multiple.html'));

        $this->assertCount(2, $elements);
        $this->assertStringContainsString('"name":"RDFa One"', $elements[0]->content);
        $this->assertStringContainsString('"name":"RDFa Two"', $elements[1]->content);
    }

    public function testItRaisesAnExplicitExceptionForASingleInvalidRdfaElementInARegularWebPage(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid RDFa document');

        $this->createExtractor()->extract($this->fixture('rdfa-invalid-single.html'));
    }

    public function testItRaisesAnExplicitExceptionForMultipleInvalidRdfaElementsInARegularWebPage(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessage('Invalid RDFa document');

        $this->createExtractor()->extract($this->fixture('rdfa-invalid-multiple.html'));
    }

    public function testItStillExtractsTypeWhenInvalidJsonLdAndValidMicrodataAreMixed(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('mixed-invalid-jsonld-valid-microdata.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"@type":"Person"', $elements[0]->content);
        $this->assertStringContainsString('"name":"Valid Micro With Broken Json"', $elements[0]->content);
    }

    public function testItStillExtractsTypeWhenValidJsonLdAndInvalidMicrodataAreMixed(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('mixed-valid-jsonld-invalid-microdata.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('Valid Json With Broken Micro', $elements[0]->content);
    }

    public function testItStillExtractsTypeWhenInvalidJsonLdAndValidRdfaAreMixed(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('mixed-invalid-jsonld-valid-rdfa.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('"name":"Valid RDFa With Broken Json"', $elements[0]->content);
    }

    public function testItStillExtractsTypeWhenValidJsonLdAndInvalidRdfaAreMixed(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('mixed-valid-jsonld-invalid-rdfa.html'));

        $this->assertCount(1, $elements);
        $this->assertStringContainsString('Valid Json With Broken RDFa', $elements[0]->content);
    }

    public function testItKeepsAllUsableSupportedFormatsInAWickedMixedDocument(): void
    {
        $elements = $this->createExtractor()->extract($this->fixture('wicked-mixed-document.html'));

        // 9 elements: 4 JSON-LD (Valid Json, Speechless Bar, Monthly Program, Course, Product),
        // 3 Microdata (Valid Micro, Speechless program highlights, stub Person with no properties),
        // 1 RDFa (Valid RDFa).
        // The stub Person comes from a wicked-invalid-micro-b element that has itemscope+itemtype
        // but only misspelled itemprop attributes — it is extractable but content-less.
        $this->assertCount(9, $elements);

        $contents = implode("\n", array_map(static fn ($element) => $element->content, $elements));

        $this->assertStringContainsString('Wicked Valid Json', $contents);
        $this->assertStringContainsString('"name":"Speechless Bar"', $contents);
        $this->assertStringContainsString('Speechless Monthly Program - April 2026', $contents);
        $this->assertStringContainsString('"name":"Wicked Valid Micro"', $contents);
        $this->assertStringContainsString('"name":"Speechless program highlights"', $contents);
        $this->assertStringContainsString('"name":"Wicked Valid RDFa"', $contents);
    }

    public function testItLogsAWarningWhenAFormatIsDetectedButMalformed(): void
    {
        $warnings = [];
        $storeWarning = static function (string $message) use (&$warnings): void {
            $warnings[] = $message;
        };

        $logger = new class($storeWarning) extends \Psr\Log\AbstractLogger {
            public function __construct(
                private readonly \Closure $storeWarning,
            ) {
            }

            public function log($level, string|\Stringable $message, array $context = []): void
            {
                if (\Psr\Log\LogLevel::WARNING === $level) {
                    ($this->storeWarning)((string) $message);
                }
            }
        };

        // This fixture has broken JSON-LD and valid microdata.
        // The JSON-LD extractor throws, but microdata saves the day — the exception is currently
        // swallowed silently. With a logger injected, it should produce a warning instead.
        $extractor = new Extractor(logger: $logger);
        $elements = $extractor->extract($this->fixture('mixed-invalid-jsonld-valid-microdata.html'));

        $this->assertCount(1, $elements);
        $this->assertCount(1, $warnings);
        $this->assertStringContainsString('jsonld', $warnings[0]);
        $this->assertStringContainsString('malformed', $warnings[0]);

        $documentIssues = $extractor->getDocumentIssues();
        $this->assertCount(1, $documentIssues);
        $this->assertSame('jsonld', $documentIssues[0]->source);
        $this->assertStringContainsString('could not extract usable content', $documentIssues[0]->message);
    }

    public function testItPropagatesDocumentIssuesToMappedTypeWarningsInTheValidator(): void
    {
        // This fixture has broken JSON-LD and valid microdata.
        // Validator::audit() must expose the warning through the Audit object.
        $validator = new Validator();
        $audit = $validator->audit($this->fixture('mixed-invalid-jsonld-valid-microdata.html'));
        $types = $audit->getTypes();

        $this->assertNotEmpty($types);

        /** @var array<\Jolicode\JsonLd\Mapper\MappedError> $documentIssues */
        $documentIssues = $audit->getDiagnostic(new AuditOptions(severity: AuditOptions::SEVERITY_DOCUMENT, asObject: true));
        $this->assertCount(1, $documentIssues);
        $issue = $documentIssues[0];
        $this->assertStringContainsString('Invalid JSON-LD document:', $issue->getMessage());
        $this->assertStringContainsString('could not extract usable content', $issue->getMessage());
        // Extraction warnings must NOT bleed into $errors, which would affect validity.
        $messagesFromErrors = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        ));

        /** @var array<string> $messagesFromErrors */
        foreach ($messagesFromErrors as $msg) {
            $this->assertStringNotContainsString('malformed', $msg, 'Extraction warning must not appear in $errors.');
        }
    }

    public function testItAddsLineOnlyWarningsForMalformedMicrodataThatDidNotBlockExtraction(): void
    {
        $extractor = new Extractor();
        $extractor->extract($this->fixture('mixed-valid-jsonld-invalid-microdata.html'));

        $warnings = $extractor->getDocumentIssues();

        $this->assertCount(1, $warnings);
        $this->assertSame('microdata', $warnings[0]->source);
        $this->assertStringContainsString('at line', $warnings[0]->message);
    }

    public function testItAddsLineOnlyWarningsForMalformedRdfaThatDidNotBlockExtraction(): void
    {
        $extractor = new Extractor();
        $extractor->extract($this->fixture('mixed-valid-jsonld-invalid-rdfa.html'));

        $warnings = $extractor->getDocumentIssues();

        $this->assertCount(1, $warnings);
        $this->assertSame('rdfa', $warnings[0]->source);
        $this->assertStringContainsString('at line', $warnings[0]->message);
    }

    private function createExtractor(): Extractor
    {
        return new Extractor();
    }

    private function fixture(string $name): string
    {
        $path = __DIR__ . '/fixtures/extractor/' . $name;
        $content = file_get_contents($path);

        if (false === $content) {
            throw new \RuntimeException(\sprintf('Could not read fixture "%s".', $name));
        }

        return $content;
    }
}
