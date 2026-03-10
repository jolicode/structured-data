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

final class AggregateRatingModel
{
    public const DESCRIPTION = 'The overall rating, based on a collection of reviews or ratings, of the item.';
    public const LABEL = 'aggregateRating';
    public const NAME = 'schema:aggregateRating';
    public const VALUES = ['AggregateRatingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AggregateRatingModel'];
    public const TYPES = ['Brand' => 'Jolicode\Vocabularies\SchemaOrg\Type\BrandModel', 'CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
