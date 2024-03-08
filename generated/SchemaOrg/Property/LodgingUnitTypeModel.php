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

final class LodgingUnitTypeModel
{
    public const DESCRIPTION = 'Textual description of the unit type (including suite vs. room, size of bed, etc.).';
    public const LABEL = 'lodgingUnitType';
    public const NAME = 'schema:lodgingUnitType';
    public const VALUES = ['QualitativeValueModel' => 'SchemaOrg\\Type\\QualitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['LodgingReservation' => 'SchemaOrg\\Type\\LodgingReservationModel'];
}
