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

final class PriceRangeModel
{
    public const DESCRIPTION = 'The price range of the business, for example ```$$$```.';
    public const LABEL = 'priceRange';
    public const NAME = 'schema:priceRange';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['LocalBusiness' => 'Jolicode\SchemaOrg\Type\LocalBusinessModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
