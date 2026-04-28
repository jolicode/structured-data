<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class OffersModel
{
    public const DESCRIPTION = 'An offer to provide this item&#x2014;for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use [[businessFunction]] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a [[Demand]]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.';
    public const LABEL = 'offers';
    public const NAME = 'schema:offers';
    public const VALUES = ['DemandModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'OfferModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const TYPES = ['AggregateOffer' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\AggregateOfferModel', 'CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'EducationalOccupationalProgram' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel', 'Event' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EventModel', 'MenuItem' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MenuItemModel', 'Product' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ServiceModel', 'Trip' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TripModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
