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

final class TotalPaymentDueModel
{
    public const DESCRIPTION = 'The total amount due.';
    public const LABEL = 'totalPaymentDue';
    public const NAME = 'schema:totalPaymentDue';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\SchemaOrg\Type\MonetaryAmountModel', 'PriceSpecificationModel' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['Invoice' => 'Jolicode\SchemaOrg\Type\InvoiceModel'];
}
