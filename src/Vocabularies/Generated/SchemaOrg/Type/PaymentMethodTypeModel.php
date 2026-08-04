<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Type;

use Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class PaymentMethodTypeModel
{
    public const DESCRIPTION = 'The type of payment method, only for generic payment types, specific forms of payments, like card payment should be expressed using subclasses of PaymentMethod.';
    public const LABEL = 'PaymentMethodType';
    public const NAME = 'schema:PaymentMethodType';
    public const PARENTS = ['EnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EnumerationModel'];
    public const ENUMERATION_MEMBERS = ['ByBankTransferInAdvanceModel' => 'EnumerationMember\ByBankTransferInAdvanceModel', 'ByInvoiceModel' => 'EnumerationMember\ByInvoiceModel', 'CODModel' => 'EnumerationMember\CODModel', 'CashModel' => 'EnumerationMember\CashModel', 'CheckInAdvanceModel' => 'EnumerationMember\CheckInAdvanceModel', 'DirectDebitModel' => 'EnumerationMember\DirectDebitModel', 'InStorePrepayModel' => 'EnumerationMember\InStorePrepayModel', 'PhoneCarrierPaymentModel' => 'EnumerationMember\PhoneCarrierPaymentModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3537'];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\SupersededByModel $supersededBy = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
