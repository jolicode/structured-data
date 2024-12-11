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

final class SellerModel
{
    public const DESCRIPTION = 'An entity which offers (sells / leases / lends / loans) the services / goods.  A seller may also be a provider.';
    public const LABEL = 'seller';
    public const NAME = 'schema:seller';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['BuyAction' => 'Jolicode\SchemaOrg\Type\BuyActionModel', 'Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Flight' => 'Jolicode\SchemaOrg\Type\FlightModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'Order' => 'Jolicode\SchemaOrg\Type\OrderModel'];
}
