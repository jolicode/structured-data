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

final class ReviewsModel
{
    public const DESCRIPTION = 'Review of the item.';
    public const LABEL = 'reviews';
    public const NAME = 'schema:reviews';
    public const VALUES = ['ReviewModel' => 'Jolicode\SchemaOrg\Type\ReviewModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
