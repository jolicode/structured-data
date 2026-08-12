<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class IsAcceptingNewPatientsModel
{
    public const DESCRIPTION = 'Whether the provider is accepting new patients.';
    public const LABEL = 'isAcceptingNewPatients';
    public const NAME = 'schema:isAcceptingNewPatients';
    public const VALUES = ['BooleanModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['MedicalOrganization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MedicalOrganizationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1062'];
    public const SUPERSEDED_BY = null;
}
