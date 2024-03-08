<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class PartySizeModel
{
    public const DESCRIPTION = 'Number of people the reservation should accommodate.';
    public const LABEL = 'partySize';
    public const NAME = 'schema:partySize';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel', 'QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['FoodEstablishmentReservation' => 'SchemaOrg\Type\FoodEstablishmentReservationModel', 'TaxiReservation' => 'SchemaOrg\Type\TaxiReservationModel'];
}
