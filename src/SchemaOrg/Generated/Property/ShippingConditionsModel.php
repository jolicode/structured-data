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

final class ShippingConditionsModel
{
    public const DESCRIPTION = 'The conditions (constraints, price) applicable to the [[ShippingService]].';
    public const LABEL = 'shippingConditions';
    public const NAME = 'schema:shippingConditions';
    public const VALUES = ['ShippingConditionsModel' => 'Jolicode\SchemaOrg\Type\ShippingConditionsModel'];
    public const TYPES = ['ShippingService' => 'Jolicode\SchemaOrg\Type\ShippingServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
