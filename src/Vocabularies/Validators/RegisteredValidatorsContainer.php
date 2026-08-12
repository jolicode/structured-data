<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Validators;

use JoliCode\StructuredData\Vocabularies\Validators\Google\GoogleValidator;
use JoliCode\StructuredData\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;

readonly class RegisteredValidatorsContainer
{
    private const VALIDATOR_ALIASES = [
        'schemaorg' => SchemaOrgValidator::class,
        'google' => GoogleValidator::class,
    ];

    public function __construct(
        /**
         * @var ValidatorInterface[]
         */
        private readonly array $validators = [
            SchemaOrgValidator::class => new SchemaOrgValidator(),
            GoogleValidator::class => new GoogleValidator(),
        ],
    ) {
    }

    public function getValidator(string $validator): ValidatorInterface
    {
        if (!isset($this->validators[$validator])) {
            throw new \InvalidArgumentException(\sprintf('Unknown validator "%s".', $validator));
        }

        return $this->validators[$validator];
    }

    /**
     * @return ValidatorInterface[]
     */
    public function getValidators(): array
    {
        return $this->validators;
    }

    public function getValidatorClassName(string $validatorSimpleName): false|string
    {
        return self::VALIDATOR_ALIASES[$this->normalizeValidatorName($validatorSimpleName)] ?? false;
    }

    private function normalizeValidatorName(string $validatorSimpleName): string
    {
        return str_replace(['.', '-', '_'], '', strtolower($validatorSimpleName));
    }
}
