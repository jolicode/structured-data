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

use Jolicode\Vocabularies\Mapper\MappedType;
use Jolicode\Vocabularies\Validator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Finder;

abstract class AbstractValidatorTestCase extends TestCase
{
    protected Validator $validator;

    protected function setUp(): void
    {
        $this->validator = new Validator();
    }

    protected function assertValidationResultMatchesExpectations(string $filePath, bool $isValid, array $expectedMessages, string $specificValidator): void
    {
        $this->validator->setValidator($specificValidator);
        $types = $this->validator->getTypes($filePath);

        $containsErrors = false;

        foreach ($types as $type) {
            if ($type->errors) {
                $containsErrors = true;
            }
        }

        $this->assertSame($isValid, !$containsErrors);

        $errorMessages = $this->collectErrorMessages($types);

        sort($expectedMessages);
        sort($errorMessages);

        $this->assertSame($expectedMessages, $errorMessages);
    }

    protected function assertDocumentIsValidForValidator(string $document, string $specificValidator): void
    {
        $this->validator->setValidator($specificValidator);
        $types = $this->validator->getTypes($document);

        $errorMessages = $this->collectErrorMessages($types);

        sort($errorMessages);

        $this->assertSame([], $errorMessages);
    }

    protected function provideData(string $path, string $baselinePath): \Generator
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

    /**
     * @param array<MappedType> $types
     *
     * @return array<string>
     */
    private function collectErrorMessages(array $types): array
    {
        $errorMessages = [];
        $typesWithError = array_filter(
            $types,
            static fn (MappedType $type) => (bool) $type->errors,
        );

        foreach ($typesWithError as $typeWithError) {
            $errorMessages = array_merge($errorMessages, $typeWithError->getErrorMessages(true));
        }

        return $errorMessages;
    }
}
