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

final class AggregateRatingModel
{
    public const DESCRIPTION = 'The overall rating, based on a collection of reviews or ratings, of the item.';
    public const LABEL = 'aggregateRating';
    public const NAME = 'schema:aggregateRating';
    public const VALUES = ['AggregateRatingModel' => 'SchemaOrg\\Type\\AggregateRatingModel'];
    public const TYPES = ['Brand' => 'SchemaOrg\\Type\\BrandModel', 'CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'Event' => 'SchemaOrg\\Type\\EventModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel', 'Organization' => 'SchemaOrg\\Type\\OrganizationModel', 'Place' => 'SchemaOrg\\Type\\PlaceModel', 'Product' => 'SchemaOrg\\Type\\ProductModel', 'Service' => 'SchemaOrg\\Type\\ServiceModel'];
}
