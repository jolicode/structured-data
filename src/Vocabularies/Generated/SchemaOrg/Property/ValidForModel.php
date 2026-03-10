<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class ValidForModel
{
    public const DESCRIPTION = 'The duration of validity of a permit or similar thing.';
    public const LABEL = 'validFor';
    public const NAME = 'schema:validFor';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['EducationalOccupationalCredential' => 'Jolicode\Vocabularies\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'Permit' => 'Jolicode\Vocabularies\SchemaOrg\Type\PermitModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
