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

final class ColorSwatchModel
{
    public const DESCRIPTION = 'A color swatch image, visualizing the color of a [[Product]]. Should match the textual description specified in the [[color]] property. This can be a URL or a fully described ImageObject.';
    public const LABEL = 'colorSwatch';
    public const NAME = 'schema:colorSwatch';
    public const VALUES = ['ImageObjectModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ImageObjectModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Product' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3423'];
    public const SUPERSEDED_BY = null;
}
