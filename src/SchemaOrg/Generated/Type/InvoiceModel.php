<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Type;

use Jolicode\SchemaOrg\Property;

final class InvoiceModel
{
    public const DESCRIPTION = 'A statement of the money due for goods or services; a bill.';
    public const LABEL = 'Invoice';
    public const NAME = 'schema:Invoice';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AccountIdModel $accountId = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BillingPeriodModel $billingPeriod = null,
        public ?Property\BrokerModel $broker = null,
        public ?Property\CategoryModel $category = null,
        public ?Property\ConfirmationNumberModel $confirmationNumber = null,
        public ?Property\CustomerModel $customer = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MinimumPaymentDueModel $minimumPaymentDue = null,
        public ?Property\NameModel $name = null,
        public ?Property\PaymentDueModel $paymentDue = null,
        public ?Property\PaymentDueDateModel $paymentDueDate = null,
        public ?Property\PaymentMethodModel $paymentMethod = null,
        public ?Property\PaymentMethodIdModel $paymentMethodId = null,
        public ?Property\PaymentStatusModel $paymentStatus = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\ReferencesOrderModel $referencesOrder = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\ScheduledPaymentDateModel $scheduledPaymentDate = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TotalPaymentDueModel $totalPaymentDue = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
