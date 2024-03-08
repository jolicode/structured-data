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

final class RequiredQuantityModel
{
    public const DESCRIPTION = 'The required quantity of the item(s).';
    public const LABEL = 'requiredQuantity';
    public const NAME = 'schema:requiredQuantity';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel', 'QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['HowToItem' => 'SchemaOrg\\Type\\HowToItemModel'];
}
