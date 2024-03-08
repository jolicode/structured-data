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

final class DiscountModel
{
    public const DESCRIPTION = 'Any discount applied (to an Order).';
    public const LABEL = 'discount';
    public const NAME = 'schema:discount';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Order' => 'SchemaOrg\\Type\\OrderModel'];
}
