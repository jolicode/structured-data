<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class PartOfOrderModel
{
    public const DESCRIPTION = 'The overall order the items in this delivery were included in.';
    public const LABEL = 'partOfOrder';
    public const NAME = 'schema:partOfOrder';
    public const VALUES = ['OrderModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const TYPES = ['ParcelDelivery' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ParcelDeliveryModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
