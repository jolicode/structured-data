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

final class ValueModel
{
    public const DESCRIPTION = 'The value of a [[QuantitativeValue]] (including [[Observation]]) or property value node.\\n\\n* For [[QuantitativeValue]] and [[MonetaryAmount]], the recommended type for values is \'Number\'.\\n* For [[PropertyValue]], it can be \'Text\', \'Number\', \'Boolean\', or \'StructuredValue\'.\\n* Use values from 0123456789 (Unicode \'DIGIT ZERO\' (U+0030) to \'DIGIT NINE\' (U+0039)) rather than superficially similar Unicode symbols.\\n* Use \'.\' (Unicode \'FULL STOP\' (U+002E)) rather than \',\' to indicate a decimal point. Avoid using these symbols as a readability separator.';
    public const LABEL = 'value';
    public const NAME = 'schema:value';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel', 'NumberModel' => 'SchemaOrg\\Type\\NumberModel', 'StructuredValueModel' => 'SchemaOrg\\Type\\StructuredValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['MonetaryAmount' => 'SchemaOrg\\Type\\MonetaryAmountModel', 'PropertyValue' => 'SchemaOrg\\Type\\PropertyValueModel', 'QuantitativeValue' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
}
