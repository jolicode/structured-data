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

final class AcceptedPaymentMethodModel
{
    public const DESCRIPTION = 'The payment method(s) accepted by seller for this offer.';
    public const LABEL = 'acceptedPaymentMethod';
    public const NAME = 'schema:acceptedPaymentMethod';
    public const VALUES = ['LoanOrCreditModel' => 'SchemaOrg\\Type\\LoanOrCreditModel', 'PaymentMethodModel' => 'SchemaOrg\\Type\\PaymentMethodModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\\Type\\DemandModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel'];
}
