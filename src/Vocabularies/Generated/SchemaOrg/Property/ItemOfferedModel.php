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

final class ItemOfferedModel
{
    public const DESCRIPTION = 'An item being offered (or demanded). The transactional nature of the offer or demand is documented using [[businessFunction]], e.g. sell, lease etc. While several common expected types are listed explicitly in this definition, others can be used. Using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.';
    public const LABEL = 'itemOffered';
    public const NAME = 'schema:itemOffered';
    public const VALUES = ['AggregateOfferModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AggregateOfferModel', 'CreativeWorkModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'EventModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel', 'MenuItemModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MenuItemModel', 'ProductModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'ServiceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel', 'TripModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TripModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
