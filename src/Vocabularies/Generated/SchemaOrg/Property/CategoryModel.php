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

final class CategoryModel
{
    public const DESCRIPTION = 'A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.';
    public const LABEL = 'category';
    public const NAME = 'schema:category';
    public const VALUES = ['CategoryCodeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CategoryCodeModel', 'PhysicalActivityCategoryModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PhysicalActivityCategoryModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'ThingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\ActionAccessSpecificationModel', 'Guide' => 'Jolicode\Vocabularies\SchemaOrg\Type\GuideModel', 'Invoice' => 'Jolicode\Vocabularies\SchemaOrg\Type\InvoiceModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'PhysicalActivity' => 'Jolicode\Vocabularies\SchemaOrg\Type\PhysicalActivityModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'Recommendation' => 'Jolicode\Vocabularies\SchemaOrg\Type\RecommendationModel', 'Service' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServiceModel', 'SpecialAnnouncement' => 'Jolicode\Vocabularies\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
