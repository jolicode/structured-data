<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ItemOfferedModel
{
    public const DESCRIPTION = 'An item being offered (or demanded). The transactional nature of the offer or demand is documented using [[businessFunction]], e.g. sell, lease etc. While several common expected types are listed explicitly in this definition, others can be used. Using a second type, such as Product or a subtype of Product, can clarify the nature of the offer.';
    public const LABEL = 'itemOffered';
    public const NAME = 'schema:itemOffered';
    public const VALUES = ['AggregateOfferModel' => 'Jolicode\SchemaOrg\Type\AggregateOfferModel', 'CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'EventModel' => 'Jolicode\SchemaOrg\Type\EventModel', 'MenuItemModel' => 'Jolicode\SchemaOrg\Type\MenuItemModel', 'ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel', 'ServiceModel' => 'Jolicode\SchemaOrg\Type\ServiceModel', 'TripModel' => 'Jolicode\SchemaOrg\Type\TripModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel'];
}
