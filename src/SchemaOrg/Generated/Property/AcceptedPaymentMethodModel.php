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

final class AcceptedPaymentMethodModel
{
    public const DESCRIPTION = 'The payment method(s) that are accepted in general by an organization, or for some specific demand or offer.';
    public const LABEL = 'acceptedPaymentMethod';
    public const NAME = 'schema:acceptedPaymentMethod';
    public const VALUES = ['LoanOrCreditModel' => 'Jolicode\SchemaOrg\Type\LoanOrCreditModel', 'PaymentMethodModel' => 'Jolicode\SchemaOrg\Type\PaymentMethodModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
