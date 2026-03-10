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

final class PartySizeModel
{
    public const DESCRIPTION = 'Number of people the reservation should accommodate.';
    public const LABEL = 'partySize';
    public const NAME = 'schema:partySize';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\IntegerModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['FoodEstablishmentReservation' => 'Jolicode\Vocabularies\SchemaOrg\Type\FoodEstablishmentReservationModel', 'TaxiReservation' => 'Jolicode\Vocabularies\SchemaOrg\Type\TaxiReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
