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

final class MaxValueModel
{
    public const DESCRIPTION = 'The upper value of some characteristic or property.';
    public const LABEL = 'maxValue';
    public const NAME = 'schema:maxValue';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['MonetaryAmount' => 'SchemaOrg\\Type\\MonetaryAmountModel', 'PropertyValue' => 'SchemaOrg\\Type\\PropertyValueModel', 'PropertyValueSpecification' => 'SchemaOrg\\Type\\PropertyValueSpecificationModel', 'QuantitativeValue' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
}
