<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class IsRelatedToModel
{
    public const DESCRIPTION = 'A pointer to another, somehow related product (or multiple products).';
    public const LABEL = 'isRelatedTo';
    public const NAME = 'schema:isRelatedTo';
    public const VALUES = ['ProductModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel', 'ServiceModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ServiceModel'];
    public const TYPES = ['Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel', 'Service' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
