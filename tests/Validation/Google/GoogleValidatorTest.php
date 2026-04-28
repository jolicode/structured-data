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

use Jolicode\Vocabularies\Validators\Google\GoogleValidator;

/**
 * @covers \Jolicode\Vocabularies\JsonLdValidator
 * @covers \Jolicode\Vocabularies\Validators\GoogleValidator
 *
 * @group validation
 * @group google
 */
class GoogleValidatorTest extends AbstractValidatorTestCase
{
    /**
     * @dataProvider provideGoogleFiles
     */
    public function testGoogleValidator(string $filePath, bool $isValid, array $expectedMessages): void
    {
        $this->assertValidationResultMatchesExpectations($filePath, $isValid, $expectedMessages, GoogleValidator::class);
    }

    public function testGoogleValidatorAcceptsMixedCaseTypeAndPropertyKeys(): void
    {
        $document = file_get_contents(__DIR__ . '/../fixtures/Google/movie.jsonld');
        $this->assertNotFalse($document);

        $document = str_replace('"@type": "Movie"', '"@type": "mOVie"', $document);
        $document = str_replace('"image": "https://example.com/photos/inception.jpg"', '"Image": "https://example.com/photos/inception.jpg"', $document);

        $this->assertDocumentIsValidForValidator($document, GoogleValidator::class);
    }

    public function provideGoogleFiles(): \Generator
    {
        return $this->provideData(
            __DIR__ . '/../fixtures/Google',
            __DIR__ . '/../fixtures/google-baseline.json',
        );
    }
}
