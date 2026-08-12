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

final class MinimumPaymentDueModel
{
    public const DESCRIPTION = 'The minimum payment required at this time.';
    public const LABEL = 'minimumPaymentDue';
    public const NAME = 'schema:minimumPaymentDue';
    public const VALUES = ['MonetaryAmountModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MonetaryAmountModel', 'PriceSpecificationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['Invoice' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
