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

final class LeaseLengthModel
{
    public const DESCRIPTION = 'Length of the lease for some [[Accommodation]], either particular to some [[Offer]] or in some cases intrinsic to the property.';
    public const LABEL = 'leaseLength';
    public const NAME = 'schema:leaseLength';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DurationModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\Vocabularies\SchemaOrg\Type\AccommodationModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'RealEstateListing' => 'Jolicode\Vocabularies\SchemaOrg\Type\RealEstateListingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
