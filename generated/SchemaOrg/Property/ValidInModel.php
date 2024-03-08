<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ValidInModel
{
    public const DESCRIPTION = 'The geographic area where a permit or similar thing is valid.';
    public const LABEL = 'validIn';
    public const NAME = 'schema:validIn';
    public const VALUES = ['AdministrativeAreaModel' => 'SchemaOrg\\Type\\AdministrativeAreaModel'];
    public const TYPES = ['EducationalOccupationalCredential' => 'SchemaOrg\\Type\\EducationalOccupationalCredentialModel', 'Permit' => 'SchemaOrg\\Type\\PermitModel'];
}
