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

final class ReviewsModel
{
    public const DESCRIPTION = 'Review of the item.';
    public const LABEL = 'reviews';
    public const NAME = 'schema:reviews';
    public const VALUES = ['ReviewModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReviewModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
