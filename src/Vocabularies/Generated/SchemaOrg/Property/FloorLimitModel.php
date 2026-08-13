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

final class FloorLimitModel
{
    public const DESCRIPTION = 'A floor limit is the amount of money above which credit card transactions must be authorized.';
    public const LABEL = 'floorLimit';
    public const NAME = 'schema:floorLimit';
    public const VALUES = ['MonetaryAmountModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel'];
    public const TYPES = ['PaymentCard' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PaymentCardModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1253'];
    public const SUPERSEDED_BY = null;
}
