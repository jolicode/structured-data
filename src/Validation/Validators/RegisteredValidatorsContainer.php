<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\Validators;

use Jolicode\JsonLd\Validation\Validators\Google\GoogleValidator;
use Jolicode\JsonLd\Validation\Validators\SchemaOrg\SchemaOrgValidator;

readonly class RegisteredValidatorsContainer
{
    public function __construct(
        /**
         * @var ValidatorInterface[]
         */
        private readonly array $validators = [
            SchemaOrgValidator::class => new SchemaOrgValidator(),
            // GoogleValidator::class => new GoogleValidator(),
        ],
    ) {
    }

    public function getValidator(string $validator): ValidatorInterface
    {
        return $this->validators[$validator];
    }

    /**
     * @return ValidatorInterface[]
     */
    public function getValidators(): array
    {
        return $this->validators;
    }
}
