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

final class DownPaymentModel
{
    public const DESCRIPTION = 'a type of payment made in cash during the onset of the purchase of an expensive good/service. The payment typically represents only a percentage of the full purchase price.';
    public const LABEL = 'downPayment';
    public const NAME = 'schema:downPayment';
    public const VALUES = ['MonetaryAmountModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MonetaryAmountModel', 'NumberModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['RepaymentSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\RepaymentSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
