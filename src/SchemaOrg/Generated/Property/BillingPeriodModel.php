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

final class BillingPeriodModel
{
    public const DESCRIPTION = 'The time interval used to compute the invoice.';
    public const LABEL = 'billingPeriod';
    public const NAME = 'schema:billingPeriod';
    public const VALUES = ['DurationModel' => 'Jolicode\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['Invoice' => 'Jolicode\SchemaOrg\Type\InvoiceModel'];
}
