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

final class ItemOfferedModel
{
    public const DESCRIPTION = 'An item being offered (or demanded). The transactional nature of the offer or demand is documented using [[businessFunction]], e.g. sell, lease etc. While several common expected types are listed explicitly in this definition, others can be used. Using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.';
    public const LABEL = 'itemOffered';
    public const NAME = 'schema:itemOffered';
    public const VALUES = ['AggregateOfferModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AggregateOfferModel', 'CreativeWorkModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'EventModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EventModel', 'MenuItemModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MenuItemModel', 'ProductModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel', 'ServiceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ServiceModel', 'TripModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TripModel'];
    public const TYPES = ['Demand' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
