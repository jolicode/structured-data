<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class MinimumPaymentDueModel
{
    public const DESCRIPTION = 'The minimum payment required at this time.';
    public const LABEL = 'minimumPaymentDue';
    public const NAME = 'schema:minimumPaymentDue';
    public const VALUES = ['MonetaryAmountModel' => 'SchemaOrg\\Type\\MonetaryAmountModel', 'PriceSpecificationModel' => 'SchemaOrg\\Type\\PriceSpecificationModel'];
    public const TYPES = ['Invoice' => 'SchemaOrg\\Type\\InvoiceModel'];
}
