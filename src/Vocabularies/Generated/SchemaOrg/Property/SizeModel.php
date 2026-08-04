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

final class SizeModel
{
    public const DESCRIPTION = 'A standardized size of a product or creative work, specified either through a simple textual string (for example \'XL\', \'32Wx34L\'), a  QuantitativeValue with a unitCode, or a comprehensive and structured [[SizeSpecification]]; in other cases, the [[width]], [[height]], [[depth]] and [[weight]] properties may be more applicable.';
    public const LABEL = 'size';
    public const NAME = 'schema:size';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel', 'SizeSpecificationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SizeSpecificationModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'Product' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1797'];
    public const SUPERSEDED_BY = null;
}
