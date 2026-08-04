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

final class JurisdictionModel
{
    public const DESCRIPTION = 'Indicates a legal jurisdiction, e.g. of some legislation, or where some government service is based.';
    public const LABEL = 'jurisdiction';
    public const NAME = 'schema:jurisdiction';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AdministrativeAreaModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['GovernmentService' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\GovernmentServiceModel', 'Legislation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2534'];
    public const SUPERSEDED_BY = null;
}
