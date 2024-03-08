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

namespace SchemaOrg\EnumerationMember;

final class PaymentDueModel
{
    public const DESCRIPTION = 'The payment is due, but still within an acceptable time to be received.';
    public const LABEL = 'PaymentDue';
    public const NAME = 'schema:PaymentDue';
}
