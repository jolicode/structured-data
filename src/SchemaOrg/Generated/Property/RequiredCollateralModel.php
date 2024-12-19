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

final class RequiredCollateralModel
{
    public const DESCRIPTION = 'Assets required to secure loan or credit repayments. It may take form of third party pledge, goods, financial instruments (cash, securities, etc.)';
    public const LABEL = 'requiredCollateral';
    public const NAME = 'schema:requiredCollateral';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['LoanOrCredit' => 'Jolicode\SchemaOrg\Type\LoanOrCreditModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
