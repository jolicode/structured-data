<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class RequiredQuantityModel
{
    public const DESCRIPTION = 'The required quantity of the item(s).';
    public const LABEL = 'requiredQuantity';
    public const NAME = 'schema:requiredQuantity';
    public const VALUES = ['NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowToItem' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToItemModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
