<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Validators;

use Jolicode\Vocabularies\Validators\Google\GoogleValidator;
use Jolicode\Vocabularies\Validators\SchemaOrg\SchemaOrgValidator;

readonly class RegisteredValidatorsContainer
{
    private const VALIDATOR_ALIASES = [
        'schemaorg' => SchemaOrgValidator::class,
        'google' => GoogleValidator::class,
    ];

    public function __construct(
        /**
         * @var AbstractValidator[]
         */
        private readonly array $validators = [
            SchemaOrgValidator::class => new SchemaOrgValidator(),
            GoogleValidator::class => new GoogleValidator(),
        ],
    ) {
    }

    public function getValidator(string $validator): AbstractValidator
    {
        return $this->validators[$validator];
    }

    /**
     * @return AbstractValidator[]
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
