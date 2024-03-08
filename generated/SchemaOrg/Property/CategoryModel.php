<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class CategoryModel
{
    public const DESCRIPTION = 'A category for the item. Greater signs or slashes can be used to informally indicate a category hierarchy.';
    public const LABEL = 'category';
    public const NAME = 'schema:category';
    public const VALUES = ['CategoryCodeModel' => 'SchemaOrg\\Type\\CategoryCodeModel', 'PhysicalActivityCategoryModel' => 'SchemaOrg\\Type\\PhysicalActivityCategoryModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'ThingModel' => 'SchemaOrg\\Type\\ThingModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['ActionAccessSpecification' => 'SchemaOrg\\Type\\ActionAccessSpecificationModel', 'Invoice' => 'SchemaOrg\\Type\\InvoiceModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel', 'PhysicalActivity' => 'SchemaOrg\\Type\\PhysicalActivityModel', 'Product' => 'SchemaOrg\\Type\\ProductModel', 'Recommendation' => 'SchemaOrg\\Type\\RecommendationModel', 'Service' => 'SchemaOrg\\Type\\ServiceModel', 'SpecialAnnouncement' => 'SchemaOrg\\Type\\SpecialAnnouncementModel'];
}
