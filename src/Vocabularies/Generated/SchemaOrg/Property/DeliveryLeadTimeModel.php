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

final class DeliveryLeadTimeModel
{
    public const DESCRIPTION = 'The typical delay between the receipt of the order and the goods either leaving the warehouse or being prepared for pickup, in case the delivery method is on site pickup.';
    public const LABEL = 'deliveryLeadTime';
    public const NAME = 'schema:deliveryLeadTime';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
