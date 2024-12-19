<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Validators;

use Jolicode\SchemaOrg\Validators\Google\GoogleValidator;
use Jolicode\SchemaOrg\Validators\SchemaOrg\SchemaOrgValidator;

readonly class RegisteredValidatorsContainer
{
    public function __construct(
        /**
         * @var AbstractValidator[]
         */
        private readonly array $validators = [
            SchemaOrgValidator::class => new SchemaOrgValidator(),
            // GoogleValidator::class => new GoogleValidator(),
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
}
