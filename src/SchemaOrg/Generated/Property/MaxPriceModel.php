<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class MaxPriceModel
{
    public const DESCRIPTION = 'The highest price if the price is a range.';
    public const LABEL = 'maxPrice';
    public const NAME = 'schema:maxPrice';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['PriceSpecification' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel'];
}
