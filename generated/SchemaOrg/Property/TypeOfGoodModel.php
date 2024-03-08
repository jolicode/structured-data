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

final class TypeOfGoodModel
{
    public const DESCRIPTION = 'The product that this structured value is referring to.';
    public const LABEL = 'typeOfGood';
    public const NAME = 'schema:typeOfGood';
    public const VALUES = ['ProductModel' => 'SchemaOrg\Type\ProductModel', 'ServiceModel' => 'SchemaOrg\Type\ServiceModel'];
    public const TYPES = ['OwnershipInfo' => 'SchemaOrg\Type\OwnershipInfoModel', 'TypeAndQuantityNode' => 'SchemaOrg\Type\TypeAndQuantityNodeModel'];
}
