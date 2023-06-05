<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\JsonLd\Validation\SchemaOrg;

use Jolicode\JsonLd\Parser\Nodes\TypeNode;
use Jolicode\JsonLd\Validation\ValidationResult;

/**
 * This class uses expanded JSON-LD documents because it is way simpler.
 */
class SchemaOrgValidator
{
    /**
     * @param array<string, \stdClass> $expandedJson
     */
    public function validate(array $expandedJson, TypeNode $type): ValidationResult
    {
        dd($type);

        $validationResult = new ValidationResult();

        // foreach ($document as $type) {
        //     $this->validateEntry($type, $validationResult);
        // }

        return $validationResult;
    }
}
