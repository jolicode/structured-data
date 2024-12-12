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

final class PriceCurrencyModel
{
    public const DESCRIPTION = 'The currency of the price, or a price component when attached to [[PriceSpecification]] and its subtypes.\n\nUse standard formats: [ISO 4217 currency format](http://en.wikipedia.org/wiki/ISO_4217), e.g. "USD"; [Ticker symbol](https://en.wikipedia.org/wiki/List_of_cryptocurrencies) for cryptocurrencies, e.g. "BTC"; well known names for [Local Exchange Trading Systems](https://en.wikipedia.org/wiki/Local_exchange_trading_system) (LETS) and other currency types, e.g. "Ithaca HOUR".';
    public const LABEL = 'priceCurrency';
    public const NAME = 'schema:priceCurrency';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DonateAction' => 'Jolicode\SchemaOrg\Type\DonateActionModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'PriceSpecification' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel', 'Reservation' => 'Jolicode\SchemaOrg\Type\ReservationModel', 'Ticket' => 'Jolicode\SchemaOrg\Type\TicketModel', 'TradeAction' => 'Jolicode\SchemaOrg\Type\TradeActionModel'];
}
