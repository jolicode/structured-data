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

final class ValueModel
{
    public const DESCRIPTION = 'The value of a [[QuantitativeValue]] (including [[Observation]]) or property value node.\n\n* For [[QuantitativeValue]] and [[MonetaryAmount]], the recommended type for values is \'Number\'.\n* For [[PropertyValue]], it can be \'Text\', \'Number\', \'Boolean\', or \'StructuredValue\'.\n* Use values from 0123456789 (Unicode \'DIGIT ZERO\' (U+0030) to \'DIGIT NINE\' (U+0039)) rather than superficially similar Unicode symbols.\n* Use \'.\' (Unicode \'FULL STOP\' (U+002E)) rather than \',\' to indicate a decimal point. Avoid using these symbols as a readability separator.';
    public const LABEL = 'value';
    public const NAME = 'schema:value';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BooleanModel', 'NumberModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\NumberModel', 'StructuredValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StructuredValueModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MonetaryAmount' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel', 'PropertyValue' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PropertyValueModel', 'QuantitativeValue' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
