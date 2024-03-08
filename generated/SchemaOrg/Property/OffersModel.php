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

final class OffersModel
{
    public const DESCRIPTION = 'An offer to provide this item&#x2014;for example, an offer to sell a product, rent the DVD of a movie, perform a service, or give away tickets to an event. Use [[businessFunction]] to indicate the kind of transaction offered, i.e. sell, lease, etc. This property can also be used to describe a [[Demand]]. While this property is listed as expected on a number of common types, it can be used in others. In that case, using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.
      ';
    public const LABEL = 'offers';
    public const NAME = 'schema:offers';
    public const VALUES = ['DemandModel' => 'SchemaOrg\Type\DemandModel', 'OfferModel' => 'SchemaOrg\Type\OfferModel'];
    public const TYPES = ['AggregateOffer' => 'SchemaOrg\Type\AggregateOfferModel', 'CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'EducationalOccupationalProgram' => 'SchemaOrg\Type\EducationalOccupationalProgramModel', 'Event' => 'SchemaOrg\Type\EventModel', 'MenuItem' => 'SchemaOrg\Type\MenuItemModel', 'Product' => 'SchemaOrg\Type\ProductModel', 'Service' => 'SchemaOrg\Type\ServiceModel', 'Trip' => 'SchemaOrg\Type\TripModel'];
}
