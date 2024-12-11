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

final class OrderModel
{
    public const DESCRIPTION = 'An order is a confirmation of a transaction (a receipt), which can contain multiple line items, each represented by an Offer that has been accepted by the customer.';
    public const LABEL = 'Order';
    public const NAME = 'schema:Order';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AcceptedOfferModel $acceptedOffer = null,
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BillingAddressModel $billingAddress = null,
        public ?Property\BrokerModel $broker = null,
        public ?Property\ConfirmationNumberModel $confirmationNumber = null,
        public ?Property\CustomerModel $customer = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\DiscountModel $discount = null,
        public ?Property\DiscountCodeModel $discountCode = null,
        public ?Property\DiscountCurrencyModel $discountCurrency = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\IsGiftModel $isGift = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\MerchantModel $merchant = null,
        public ?Property\NameModel $name = null,
        public ?Property\OrderDateModel $orderDate = null,
        public ?Property\OrderDeliveryModel $orderDelivery = null,
        public ?Property\OrderNumberModel $orderNumber = null,
        public ?Property\OrderStatusModel $orderStatus = null,
        public ?Property\OrderedItemModel $orderedItem = null,
        public ?Property\PartOfInvoiceModel $partOfInvoice = null,
        public ?Property\PaymentDueModel $paymentDue = null,
        public ?Property\PaymentDueDateModel $paymentDueDate = null,
        public ?Property\PaymentMethodModel $paymentMethod = null,
        public ?Property\PaymentMethodIdModel $paymentMethodId = null,
        public ?Property\PaymentUrlModel $paymentUrl = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SellerModel $seller = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
