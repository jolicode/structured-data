<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class SellerModel
{
    public const DESCRIPTION = 'An entity which offers (sells / leases / lends / loans) the services / goods.  A seller may also be a provider.';
    public const LABEL = 'seller';
    public const NAME = 'schema:seller';
    public const VALUES = ['OrganizationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['BuyAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BuyActionModel', 'Demand' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Flight' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\FlightModel', 'Offer' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'Order' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
