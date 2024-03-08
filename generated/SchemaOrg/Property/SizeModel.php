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

final class SizeModel
{
    public const DESCRIPTION = 'A standardized size of a product or creative work, specified either through a simple textual string (for example \'XL\', \'32Wx34L\'), a  QuantitativeValue with a unitCode, or a comprehensive and structured [[SizeSpecification]]; in other cases, the [[width]], [[height]], [[depth]] and [[weight]] properties may be more applicable. ';
    public const LABEL = 'size';
    public const NAME = 'schema:size';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\\Type\\DefinedTermModel', 'QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel', 'SizeSpecificationModel' => 'SchemaOrg\\Type\\SizeSpecificationModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel', 'Product' => 'SchemaOrg\\Type\\ProductModel'];
}
