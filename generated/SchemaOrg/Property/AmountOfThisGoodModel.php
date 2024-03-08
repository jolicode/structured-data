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

final class AmountOfThisGoodModel
{
    public const DESCRIPTION = 'The quantity of the goods included in the offer.';
    public const LABEL = 'amountOfThisGood';
    public const NAME = 'schema:amountOfThisGood';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['TypeAndQuantityNode' => 'SchemaOrg\\Type\\TypeAndQuantityNodeModel'];
}
