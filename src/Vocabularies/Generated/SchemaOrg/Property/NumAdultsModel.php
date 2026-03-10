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

final class NumAdultsModel
{
    public const DESCRIPTION = 'The number of adults staying in the unit.';
    public const LABEL = 'numAdults';
    public const NAME = 'schema:numAdults';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntegerModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['LodgingReservation' => 'Jolicode\Vocabularies\SchemaOrg\Type\LodgingReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
