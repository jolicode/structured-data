<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class OwnedFromModel
{
    public const DESCRIPTION = 'The date and time of obtaining the product.';
    public const LABEL = 'ownedFrom';
    public const NAME = 'schema:ownedFrom';
    public const VALUES = ['DateTimeModel' => 'SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['OwnershipInfo' => 'SchemaOrg\Type\OwnershipInfoModel'];
}
