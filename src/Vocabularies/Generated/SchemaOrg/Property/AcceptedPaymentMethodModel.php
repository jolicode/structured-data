<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class AcceptedPaymentMethodModel
{
    public const DESCRIPTION = 'The payment method(s) that are accepted in general by an organization, or for some specific demand or offer.';
    public const LABEL = 'acceptedPaymentMethod';
    public const NAME = 'schema:acceptedPaymentMethod';
    public const VALUES = ['LoanOrCreditModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LoanOrCreditModel', 'PaymentMethodModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PaymentMethodModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Demand' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3537'];
    public const SUPERSEDED_BY = null;
}
