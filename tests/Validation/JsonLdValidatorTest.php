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

use Jolicode\SchemaOrg\Mapper\MappedType;
use Jolicode\SchemaOrg\Validator;
use Jolicode\SchemaOrg\Validators\Google\GoogleValidator;
use Jolicode\SchemaOrg\Validators\SchemaOrg\SchemaOrgValidator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

/**
 * @covers \Jolicode\SchemaOrg\JsonLdValidator
 * @covers \Jolicode\SchemaOrg\Validators\SchemaOrgValidator
 * @covers \Jolicode\SchemaOrg\Validators\GoogleValidator
 *
 * @group validation
 */
class JsonLdValidatorTest extends TestCase
{
    private Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    /**
     * @group schemaorg
     *
     * @dataProvider provideSchemaOrgFiles
     */
    public function testSchemaOrgValidator(string $filePath, bool $isValid, array $expectedMessages): void
    {
        $this->check($filePath, $isValid, $expectedMessages, SchemaOrgValidator::class);
    }

    /**
     * @group google
     *
     * @dataProvider provideGoogleFiles
     */
    // public function testGoogleValidator(string $filePath, bool $isValid, array $expectedMessages): void
    // {
    //     $this->check($filePath, $isValid, $expectedMessages, GoogleValidator::class);
    // }

    /**
     * @group schemaorg
     *
     * @dataProvider provideSchemaOrgExamples
     */
    public function testSchemaOrgExamples(string $filePath, bool $isValid = true, array $expectedErrors = []): void
    {
        $this->check($filePath, $isValid, $expectedErrors, SchemaOrgValidator::class);
    }

    public function provideSchemaOrgExamples(): \Generator
    {
        return $this->provideData(
            __DIR__ . '/../../resources/schema.org/examples',
            __DIR__ . '/../../resources/schema.org/examples-baseline.json',
        );
    }

    public function provideSchemaOrgFiles(): \Generator
    {
        return $this->provideData(
            __DIR__ . '/fixtures/schema-org',
            __DIR__ . '/fixtures/schema-org-baseline.json',
        );
    }

    public function provideGoogleFiles(): \Generator
    {
        $path = __DIR__ . '/fixtures/Google';

        yield 'Article' => [
            'document' => $path . '/article.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        // An absolute mess ¯\_(ツ)_/¯
        yield 'Book' => [
            'document' => $path . '/book.jsonld',
            'isValid' => false,
            'messages' => [
                // Weird... The LibrarySystem type definition says URL is required, but the the Google validator does not...
                'Missing required property: "url"',
            ],
        ];

        yield 'Breadcrumb' => [
            'document' => $path . '/breadcrumb.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Carousel' => [
            'document' => $path . '/carousel.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Course Info' => [
            'document' => $path . '/course-info.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Course' => [
            'document' => $path . '/course.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Covid19' => [
            'document' => $path . '/covid19.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Dataset' => [
            'document' => $path . '/dataset.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Tabular Dataset' => [
            'document' => $path . '/dataset-tabular.jsonld',
            'isValid' => true,
            'messages' => [],
        ];

        yield 'Recipe' => [
            'document' => $path . '/recipe.jsonld',
            'isValid' => true,
            'messages' => [],
        ];
    }

    private function check(string $filePath, bool $isValid, array $expectedMessages, string $specificValidator): void
    {
        $types = $this->validator->getTypes($filePath, $specificValidator);

        $containsErrors = false;

        foreach ($types as $type) {
            if ($type->errors) {
                $containsErrors = true;
            }
        }

        $this->assertSame($isValid, !$containsErrors);
        $errorMessages = [];
        $typesWithError = array_filter(
            $types,
            fn (MappedType $type) => (bool) $type->errors,
        );

        foreach ($typesWithError as $typeWithError) {
            $errorMessages = array_merge($errorMessages, $typeWithError->getErrorMessages(true));
        }

        $this->assertSame($expectedMessages, $errorMessages);
    }

    private function provideData(string $path, string $baselinePath): \Generator
    {
        $finder = new Finder();
        $finder->files()->in($path);
        $baseline = file_get_contents($baselinePath);

        if (false === $baseline) {
            $baseline = '{}';
        }

        $baseline = json_decode($baseline, true);

        foreach ($finder as $file) {
            $errors = $baseline[$file->getFilename()] ?? [];
            yield $file->getFilename() => [
                $file->getPathname(),
                empty($errors),
                $errors,
            ];
        }
    }
}
