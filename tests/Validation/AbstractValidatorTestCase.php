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
use JoliCode\StructuredData\JsonLd\Algorithms\Http\DocumentLoaderInterface;
use JoliCode\StructuredData\Validator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

abstract class AbstractValidatorTestCase extends TestCase
{
    protected Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator(documentLoader: static::createDocumentLoader());
    }

    /**
     * A handful of the schema.org examples pull a context from outside schema.org
     * itself. Those are served from committed snapshots rather than fetched, so
     * that a third-party host being down, slow or rate-limiting never decides
     * whether this suite is green: see SnapshotDocumentLoader.
     */
    protected static function createDocumentLoader(): DocumentLoaderInterface
    {
        return new SnapshotDocumentLoader();
    }

    protected function fixture(string $path): string
    {
        $content = file_get_contents($path);

        if (false === $content) {
            throw new \RuntimeException(\sprintf('The fixture "%s" could not be read.', $path));
        }

        return $content;
    }

    protected function assertValidationResultMatchesExpectations(
        string $document,
        bool $isValid,
        array $expectedErrors,
        string $specificValidator,
        array $expectedWarnings = [],
        array $expectedDocumentIssues = [],
    ): void {
        $this->validator->setValidator($specificValidator);
        $audit = $this->validator->audit($document);

        // For actual validity check, see if there are errors (warnings alone don't make it invalid)
        $actualIsValid = $audit->isValid();

        /** @var array<string> $errorMessages */
        $errorMessages = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        ));
        /** @var array<string> $warningMessages */
        $warningMessages = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_WARNING,
        ));
        /** @var array<string> $documentIssueMessages */
        $documentIssueMessages = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_DOCUMENT,
        ));

        sort($expectedErrors);
        sort($expectedWarnings);
        sort($expectedDocumentIssues);
        sort($errorMessages);
        sort($warningMessages);
        sort($documentIssueMessages);

        $this->assertSame($isValid, $actualIsValid);
        $this->assertSame($expectedErrors, $errorMessages);
        $this->assertSame($expectedWarnings, $warningMessages);
        $this->assertSame($expectedDocumentIssues, $documentIssueMessages);
    }

    protected function assertDocumentIsValidForValidator(string $document, string $specificValidator): void
    {
        $this->validator->setValidator($specificValidator);
        $audit = $this->validator->audit($document);

        /** @var array<string> $errorMessages */
        $errorMessages = $audit->getDiagnostic(new AuditOptions(
            severity: AuditOptions::SEVERITY_ERROR,
        ));

        sort($errorMessages);

        $this->assertSame([], $errorMessages);
    }

    protected static function provideData(string $path, string $baselinePath): \Generator
    {
        $finder = new Finder();
        $finder->files()->in($path);
        $baseline = file_get_contents($baselinePath);

        if (false === $baseline) {
            $baseline = '{}';
        }

        $baseline = json_decode($baseline, true);

        foreach ($finder as $file) {
            self::assertArrayHasKey(
                $file->getFilename(),
                $baseline,
                \sprintf('Missing baseline entry for "%s" in "%s".', $file->getFilename(), $baselinePath),
            );

            $baselineEntry = $baseline[$file->getFilename()] ?? [];
            $expectedErrors = [];
            $expectedWarnings = [];
            $expectedDocumentIssues = [];

            if (array_is_list($baselineEntry)) {
                $expectedErrors = $baselineEntry;
            } else {
                $expectedErrors = $baselineEntry['errors'] ?? [];
                $expectedWarnings = $baselineEntry['warnings'] ?? [];
                $expectedDocumentIssues = $baselineEntry['documentIssues'] ?? [];
            }

            sort($expectedErrors);
            sort($expectedWarnings);
            sort($expectedDocumentIssues);

            yield $file->getFilename() => [
                $file->getContents(),
                [] === $expectedErrors,
                $expectedErrors,
                $expectedWarnings,
                $expectedDocumentIssues,
            ];
        }
    }
}
