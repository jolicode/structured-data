<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PartySizeModel
{
    public const DESCRIPTION = 'Number of people the reservation should accommodate.';
    public const LABEL = 'partySize';
    public const NAME = 'schema:partySize';
    public const VALUES = ['IntegerModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntegerModel', 'QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['FoodEstablishmentReservation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FoodEstablishmentReservationModel', 'TaxiReservation' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TaxiReservationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
