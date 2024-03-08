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

final class MinPriceModel
{
    public const DESCRIPTION = 'The lowest price if the price is a range.';
    public const LABEL = 'minPrice';
    public const NAME = 'schema:minPrice';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['PriceSpecification' => 'SchemaOrg\\Type\\PriceSpecificationModel'];
}
