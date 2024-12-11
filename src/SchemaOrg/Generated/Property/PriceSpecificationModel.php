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

final class PriceSpecificationModel
{
    public const DESCRIPTION = 'One or more detailed price specifications, indicating the unit price and delivery or payment charges.';
    public const LABEL = 'priceSpecification';
    public const NAME = 'schema:priceSpecification';
    public const VALUES = ['PriceSpecificationModel' => 'Jolicode\SchemaOrg\Type\PriceSpecificationModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'TradeAction' => 'Jolicode\SchemaOrg\Type\TradeActionModel'];
}
