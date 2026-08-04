<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class PracticesAtModel
{
    public const DESCRIPTION = 'A [[MedicalOrganization]] where the [[IndividualPhysician]] practices.';
    public const LABEL = 'practicesAt';
    public const NAME = 'schema:practicesAt';
    public const VALUES = ['MedicalOrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalOrganizationModel'];
    public const TYPES = ['IndividualPhysician' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IndividualPhysicianModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3420'];
    public const SUPERSEDED_BY = null;
}
