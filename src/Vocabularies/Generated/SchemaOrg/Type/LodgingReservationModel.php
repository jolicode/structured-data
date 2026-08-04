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

final class LodgingReservationModel
{
    public const DESCRIPTION = 'A reservation for lodging at a hotel, motel, inn, etc.\n\nNote: This type is for information about actual reservations, e.g. in confirmation emails or HTML pages with individual confirmations of reservations.';
    public const LABEL = 'LodgingReservation';
    public const NAME = 'schema:LodgingReservation';
    public const PARENTS = ['ReservationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ReservationModel'];
    public const ENUMERATION_MEMBERS = [];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;

    public function __construct(
        public ?Property\AdditionalTypeModel $additionalType = null,
        public ?Property\AlternateNameModel $alternateName = null,
        public ?Property\BookingAgentModel $bookingAgent = null,
        public ?Property\BookingTimeModel $bookingTime = null,
        public ?Property\BrokerModel $broker = null,
        public ?Property\CheckinTimeModel $checkinTime = null,
        public ?Property\CheckoutTimeModel $checkoutTime = null,
        public ?Property\DescriptionModel $description = null,
        public ?Property\DisambiguatingDescriptionModel $disambiguatingDescription = null,
        public ?Property\IdentifierModel $identifier = null,
        public ?Property\ImageModel $image = null,
        public ?Property\LodgingUnitDescriptionModel $lodgingUnitDescription = null,
        public ?Property\LodgingUnitTypeModel $lodgingUnitType = null,
        public ?Property\MainEntityOfPageModel $mainEntityOfPage = null,
        public ?Property\ModifiedTimeModel $modifiedTime = null,
        public ?Property\NameModel $name = null,
        public ?Property\NumAdultsModel $numAdults = null,
        public ?Property\NumChildrenModel $numChildren = null,
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
