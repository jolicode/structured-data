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

final class RecognizingAuthorityModel
{
    public const DESCRIPTION = 'If applicable, the organization that officially recognizes this entity as part of its endorsed system of medicine.';
    public const LABEL = 'recognizingAuthority';
    public const NAME = 'schema:recognizingAuthority';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['MedicalEntity' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
