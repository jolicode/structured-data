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

final class NumItemsModel
{
    public const DESCRIPTION = 'Limits the number of items being shipped for which these conditions apply.';
    public const LABEL = 'numItems';
    public const NAME = 'schema:numItems';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['ShippingConditions' => 'Jolicode\SchemaOrg\Type\ShippingConditionsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
