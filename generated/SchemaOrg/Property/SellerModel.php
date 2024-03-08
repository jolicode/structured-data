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

namespace SchemaOrg\Property;

final class SellerModel
{
    public const DESCRIPTION = 'An entity which offers (sells / leases / lends / loans) the services / goods.  A seller may also be a provider.';
    public const LABEL = 'seller';
    public const NAME = 'schema:seller';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['BuyAction' => 'SchemaOrg\\Type\\BuyActionModel', 'Demand' => 'SchemaOrg\\Type\\DemandModel', 'Flight' => 'SchemaOrg\\Type\\FlightModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel', 'Order' => 'SchemaOrg\\Type\\OrderModel'];
}
