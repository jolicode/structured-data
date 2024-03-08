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

final class GracePeriodModel
{
    public const DESCRIPTION = 'The period of time after any due date that the borrower has to fulfil its obligations before a default (failure to pay) is deemed to have occurred.';
    public const LABEL = 'gracePeriod';
    public const NAME = 'schema:gracePeriod';
    public const VALUES = ['DurationModel' => 'SchemaOrg\\Type\\DurationModel'];
    public const TYPES = ['LoanOrCredit' => 'SchemaOrg\\Type\\LoanOrCreditModel'];
}
