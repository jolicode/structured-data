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

final class AvailabilityModel
{
    public const DESCRIPTION = 'The availability of this item&#x2014;for example In stock, Out of stock, Pre-order, etc.';
    public const LABEL = 'availability';
    public const NAME = 'schema:availability';
    public const VALUES = ['ItemAvailabilityModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ItemAvailabilityModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
