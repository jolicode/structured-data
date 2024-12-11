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

final class ValidInModel
{
    public const DESCRIPTION = 'The geographic area where a permit or similar thing is valid.';
    public const LABEL = 'validIn';
    public const NAME = 'schema:validIn';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\SchemaOrg\Type\AdministrativeAreaModel'];
    public const TYPES = ['EducationalOccupationalCredential' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'Permit' => 'Jolicode\SchemaOrg\Type\PermitModel'];
}
