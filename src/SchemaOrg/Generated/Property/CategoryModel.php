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

final class CategoryModel
{
    public const DESCRIPTION = 'A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.';
    public const LABEL = 'category';
    public const NAME = 'schema:category';
    public const VALUES = ['CategoryCodeModel' => 'Jolicode\SchemaOrg\Type\CategoryCodeModel', 'PhysicalActivityCategoryModel' => 'Jolicode\SchemaOrg\Type\PhysicalActivityCategoryModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\SchemaOrg\Type\ActionAccessSpecificationModel', 'Guide' => 'Jolicode\SchemaOrg\Type\GuideModel', 'Invoice' => 'Jolicode\SchemaOrg\Type\InvoiceModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'PhysicalActivity' => 'Jolicode\SchemaOrg\Type\PhysicalActivityModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'Recommendation' => 'Jolicode\SchemaOrg\Type\RecommendationModel', 'Service' => 'Jolicode\SchemaOrg\Type\ServiceModel', 'SpecialAnnouncement' => 'Jolicode\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
