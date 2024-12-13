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

final class OwnedThroughModel
{
    public const DESCRIPTION = 'The date and time of giving up ownership on the product.';
    public const LABEL = 'ownedThrough';
    public const NAME = 'schema:ownedThrough';
    public const VALUES = ['DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['OwnershipInfo' => 'Jolicode\SchemaOrg\Type\OwnershipInfoModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
