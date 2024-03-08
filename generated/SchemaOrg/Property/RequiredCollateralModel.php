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

final class RequiredCollateralModel
{
    public const DESCRIPTION = 'Assets required to secure loan or credit repayments. It may take form of third party pledge, goods, financial instruments (cash, securities, etc.)';
    public const LABEL = 'requiredCollateral';
    public const NAME = 'schema:requiredCollateral';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel', 'ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const TYPES = ['LoanOrCredit' => 'SchemaOrg\\Type\\LoanOrCreditModel'];
}
