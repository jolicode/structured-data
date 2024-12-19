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

final class TaxiReservationModel
{
    public const DESCRIPTION = 'A reservation for a taxi.\n\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations. For offers of tickets, use [[Offer]].';
    public const LABEL = 'TaxiReservation';
    public const NAME = 'schema:TaxiReservation';
    public const PARENTS = ['ReservationModel' => 'Jolicode\SchemaOrg\Type\ReservationModel'];
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
        public ?Property\PartySizeModel $partySize = null,
        public ?Property\PickupLocationModel $pickupLocation = null,
        public ?Property\PickupTimeModel $pickupTime = null,
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
