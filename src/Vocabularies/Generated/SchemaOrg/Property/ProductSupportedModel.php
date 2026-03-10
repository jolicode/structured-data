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

final class ProductSupportedModel
{
    public const DESCRIPTION = 'The product or service this support contact point is related to (such as product support for a particular product line). This can be a specific product or product line (e.g. "iPhone") or a general category of products or services (e.g. "smartphones").';
    public const LABEL = 'productSupported';
    public const NAME = 'schema:productSupported';
    public const VALUES = ['ProductModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ContactPoint' => 'Jolicode\Vocabularies\SchemaOrg\Type\ContactPointModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
