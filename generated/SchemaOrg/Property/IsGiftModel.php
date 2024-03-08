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

final class IsGiftModel
{
    public const DESCRIPTION = 'Indicates whether the offer was accepted as a gift for someone other than the buyer.';
    public const LABEL = 'isGift';
    public const NAME = 'schema:isGift';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel'];
    public const TYPES = ['Order' => 'SchemaOrg\\Type\\OrderModel'];
}
