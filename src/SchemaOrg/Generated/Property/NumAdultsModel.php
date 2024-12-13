<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class NumAdultsModel
{
    public const DESCRIPTION = 'The number of adults staying in the unit.';
    public const LABEL = 'numAdults';
    public const NAME = 'schema:numAdults';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel', 'QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['LodgingReservation' => 'Jolicode\SchemaOrg\Type\LodgingReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
