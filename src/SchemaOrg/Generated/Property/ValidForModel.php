<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ValidForModel
{
    public const DESCRIPTION = 'The duration of validity of a permit or similar thing.';
    public const LABEL = 'validFor';
    public const NAME = 'schema:validFor';
    public const VALUES = ['DurationModel' => 'Jolicode\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['EducationalOccupationalCredential' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'Permit' => 'Jolicode\SchemaOrg\Type\PermitModel'];
}
