<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation;

use Jolicode\JsonLd\Parser\JsonLdParser;
use Jolicode\JsonLd\Validation\Mapper\ValidationMapper;

readonly class JsonLdValidator
{
    public function __construct(
        private ValidationMapper $validationMapper = new ValidationMapper(),
        private JsonLdParser $parser = new JsonLdParser(),
    ) {
    }

    /**
     * @return array<string>
     */
    public function validate(string $jsonLdEntry)
    {
        // TODO: probably verify the JSON is valid before doing anything else
        $parsedJson = $this->parser->parse($jsonLdEntry);

        foreach (RegisteredValidatorsEnum::cases() as $validator) {
            $validator = new $validator->value();
            $validationResult = $validator->validate($jsonLdEntry);

            if (!$validationResult->isValid()) {
                $this->validationMapper->addErrors(...$validationResult->getErrors());
                $this->validationMapper->mapErrorsOnTypes($parsedJson);
            }
        }

        return $this->validationMapper->getMap($parsedJson);
    }
}
