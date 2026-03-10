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

final class ReviewModel
{
    public const DESCRIPTION = 'A review of the item.';
    public const LABEL = 'review';
    public const NAME = 'schema:review';
    public const VALUES = ['ReviewModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReviewModel'];
    public const TYPES = ['Brand' => 'Jolicode\Vocabularies\SchemaOrg\Type\BrandModel', 'CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
