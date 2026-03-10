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

final class GracePeriodModel
{
    public const DESCRIPTION = 'The period of time after any due date that the borrower has to fulfil its obligations before a default (failure to pay) is deemed to have occurred.';
    public const LABEL = 'gracePeriod';
    public const NAME = 'schema:gracePeriod';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['LoanOrCredit' => 'Jolicode\Vocabularies\SchemaOrg\Type\LoanOrCreditModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
