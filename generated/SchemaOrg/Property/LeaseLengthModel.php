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

final class LeaseLengthModel
{
    public const DESCRIPTION = 'Length of the lease for some [[Accommodation]], either particular to some [[Offer]] or in some cases intrinsic to the property.';
    public const LABEL = 'leaseLength';
    public const NAME = 'schema:leaseLength';
    public const VALUES = ['DurationModel' => 'SchemaOrg\Type\DurationModel', 'QuantitativeValueModel' => 'SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\Type\AccommodationModel', 'Offer' => 'SchemaOrg\Type\OfferModel', 'RealEstateListing' => 'SchemaOrg\Type\RealEstateListingModel'];
}
