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

final class ReservationModel
{
    public const DESCRIPTION = 'Describes a reservation for travel, dining or an event. Some reservations require tickets. \n\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations. For offers of tickets, restaurant reservations, flights, or rental cars, use [[Offer]].';
    public const LABEL = 'Reservation';
    public const NAME = 'schema:Reservation';
    public const PARENTS = ['IntangibleModel' => 'Jolicode\SchemaOrg\Type\IntangibleModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BookingAgentModel $bookingAgent = null,
        public ?Property\BookingTimeModel $bookingTime = null,
        public ?Property\BrokerModel $broker = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\ModifiedTimeModel $modifiedTime = null,
        public ?Property\NameModel $name = null,
        public ?Property\OwnerModel $owner = null,
        public ?Property\PotentialActionModel $potentialAction = null,
        public ?Property\PriceCurrencyModel $priceCurrency = null,
        public ?Property\ProgramMembershipUsedModel $programMembershipUsed = null,
        public ?Property\ProviderModel $provider = null,
        public ?Property\ReservationForModel $reservationFor = null,
        public ?Property\ReservationIdModel $reservationId = null,
        public ?Property\ReservationStatusModel $reservationStatus = null,
        public ?Property\ReservedTicketModel $reservedTicket = null,
        public ?Property\SameAsModel $sameAs = null,
        public ?Property\SubjectOfModel $subjectOf = null,
        public ?Property\TotalPriceModel $totalPrice = null,
        public ?Property\UnderNameModel $underName = null,
        public ?Property\UrlModel $url = null,
    ) {
    }
}
