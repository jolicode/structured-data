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
    public const DESCRIPTION = 'The geographic area where the item is valid. Applies for example to a [[Permit]], a [[Certification]], or an [[EducationalOccupationalCredential]].';
    public const LABEL = 'validIn';
    public const NAME = 'schema:validIn';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\SchemaOrg\Type\AdministrativeAreaModel'];
    public const TYPES = ['Certification' => 'Jolicode\SchemaOrg\Type\CertificationModel', 'EducationalOccupationalCredential' => 'Jolicode\SchemaOrg\Type\EducationalOccupationalCredentialModel', 'Permit' => 'Jolicode\SchemaOrg\Type\PermitModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
