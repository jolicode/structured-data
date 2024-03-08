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

final class DownPaymentModel
{
    public const DESCRIPTION = 'a type of payment made in cash during the onset of the purchase of an expensive good/service. The payment typically represents only a percentage of the full purchase price.';
    public const LABEL = 'downPayment';
    public const NAME = 'schema:downPayment';
    public const VALUES = ['MonetaryAmountModel' => 'SchemaOrg\\Type\\MonetaryAmountModel', 'NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['RepaymentSpecification' => 'SchemaOrg\\Type\\RepaymentSpecificationModel'];
}
