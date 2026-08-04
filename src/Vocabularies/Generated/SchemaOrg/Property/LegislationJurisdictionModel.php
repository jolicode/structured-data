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

final class LegislationJurisdictionModel
{
    public const DESCRIPTION = 'The jurisdiction from which the legislation originates.';
    public const LABEL = 'legislationJurisdiction';
    public const NAME = 'schema:legislationJurisdiction';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AdministrativeAreaModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Legislation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1156', 'https://op.europa.eu/en/web/eu-vocabularies/model/-/resource/dataset/eli'];
    public const SUPERSEDED_BY = null;
}
