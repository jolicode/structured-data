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

namespace SchemaOrg\Type;

use SchemaOrg\Property;

final class OrderItemModel
{
    public const DESCRIPTION = 'An order item is a line of an order. It includes the quantity and shipping details of a bought offer.';
    public const LABEL = 'OrderItem';
    public const NAME = 'schema:OrderItem';
    public const PARENTS = ['IntangibleModel' => 'SchemaOrg\\Type\\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\NameModel $name = null,
        public ?Property\OrderDeliveryModel $orderDelivery = null,
        public ?Property\OrderItemNumberModel $orderItemNumber = null,
        public ?Property\OrderItemStatusModel $orderItemStatus = null,
        public ?Property\OrderQuantityModel $orderQuantity = null,
        public ?Property\OrderedItemModel $orderedItem = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
