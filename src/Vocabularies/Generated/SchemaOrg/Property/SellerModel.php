<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class SellerModel
{
    public const DESCRIPTION = 'An entity which offers (sells / leases / lends / loans) the services / goods.  A seller may also be a provider.';
    public const LABEL = 'seller';
    public const NAME = 'schema:seller';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['BuyAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\BuyActionModel', 'Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'Flight' => 'Jolicode\Vocabularies\SchemaOrg\Type\FlightModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel', 'Order' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
