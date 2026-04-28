<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class SellerModel
{
    public const DESCRIPTION = 'An entity which offers (sells / leases / lends / loans) the services / goods.  A seller may also be a provider.';
    public const LABEL = 'seller';
    public const NAME = 'schema:seller';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['BuyAction' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BuyActionModel', 'Demand' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Flight' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\FlightModel', 'Offer' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'Order' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
