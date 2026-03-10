<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class WarrantyPromiseModel
{
    public const DESCRIPTION = 'The warranty promise(s) included in the offer.';
    public const LABEL = 'warrantyPromise';
    public const NAME = 'schema:warrantyPromise';
    public const VALUES = ['WarrantyPromiseModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\WarrantyPromiseModel'];
    public const TYPES = ['BuyAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\BuyActionModel', 'SellAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\SellActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
