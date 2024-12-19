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

final class ReviewModel
{
    public const DESCRIPTION = 'A review of the item.';
    public const LABEL = 'review';
    public const NAME = 'schema:review';
    public const VALUES = ['ReviewModel' => 'Jolicode\SchemaOrg\Type\ReviewModel'];
    public const TYPES = ['Brand' => 'Jolicode\SchemaOrg\Type\BrandModel', 'CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
