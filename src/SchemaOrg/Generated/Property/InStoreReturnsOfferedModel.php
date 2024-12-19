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

final class InStoreReturnsOfferedModel
{
    public const DESCRIPTION = 'Are in-store returns offered? (For more advanced return methods use the [[returnMethod]] property.)';
    public const LABEL = 'inStoreReturnsOffered';
    public const NAME = 'schema:inStoreReturnsOffered';
    public const VALUES = ['BooleanModel' => 'Jolicode\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
