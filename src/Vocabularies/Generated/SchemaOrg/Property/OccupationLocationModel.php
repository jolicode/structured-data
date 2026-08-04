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

final class OccupationLocationModel
{
    public const DESCRIPTION = 'The region/country for which this occupational description is appropriate. Note that educational requirements and qualifications can vary between jurisdictions.';
    public const LABEL = 'occupationLocation';
    public const NAME = 'schema:occupationLocation';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AdministrativeAreaModel'];
    public const TYPES = ['Occupation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OccupationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1698'];
    public const SUPERSEDED_BY = null;
}
