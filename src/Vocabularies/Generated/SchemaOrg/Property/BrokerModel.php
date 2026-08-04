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

final class BrokerModel
{
    public const DESCRIPTION = 'An entity that arranges for an exchange between a buyer and a seller.  In most cases a broker never acquires or releases ownership of a product or service involved in an exchange.  If it is not clear whether an entity is a broker, seller, or buyer, the latter two terms are preferred.';
    public const LABEL = 'broker';
    public const NAME = 'schema:broker';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Invoice' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel', 'Order' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrderModel', 'Reservation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ReservationModel', 'Service' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
