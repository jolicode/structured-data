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

final class ScheduledPaymentDateModel
{
    public const DESCRIPTION = 'The date the invoice is scheduled to be paid.';
    public const LABEL = 'scheduledPaymentDate';
    public const NAME = 'schema:scheduledPaymentDate';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Invoice' => 'Jolicode\SchemaOrg\Type\InvoiceModel'];
}
