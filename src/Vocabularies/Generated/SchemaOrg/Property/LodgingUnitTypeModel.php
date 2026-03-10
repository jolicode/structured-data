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

final class LodgingUnitTypeModel
{
    public const DESCRIPTION = 'Textual description of the unit type (including suite vs. room, size of bed, etc.).';
    public const LABEL = 'lodgingUnitType';
    public const NAME = 'schema:lodgingUnitType';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['LodgingReservation' => 'Jolicode\Vocabularies\SchemaOrg\Type\LodgingReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
