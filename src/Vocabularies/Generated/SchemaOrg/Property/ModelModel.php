<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class ModelModel
{
    public const DESCRIPTION = 'The model of the product. Use with the URL of a ProductModel or a textual representation of the model identifier. The URL of the ProductModel can be from an external source. It is recommended to additionally provide strong product identifiers via the gtin8/gtin13/gtin14 and mpn properties.';
    public const LABEL = 'model';
    public const NAME = 'schema:model';
    public const VALUES = ['ProductModelModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModelModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Product' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
