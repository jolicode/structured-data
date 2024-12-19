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

final class DiscountModel
{
    public const DESCRIPTION = 'Any discount applied (to an Order).';
    public const LABEL = 'discount';
    public const NAME = 'schema:discount';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Order' => 'Jolicode\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
