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

final class LegislationJurisdictionModel
{
    public const DESCRIPTION = 'The jurisdiction from which the legislation originates.';
    public const LABEL = 'legislationJurisdiction';
    public const NAME = 'schema:legislationJurisdiction';
    public const VALUES = ['AdministrativeAreaModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AdministrativeAreaModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Legislation' => 'Jolicode\Vocabularies\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
