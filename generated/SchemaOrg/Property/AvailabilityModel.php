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

final class AvailabilityModel
{
    public const DESCRIPTION = 'The availability of this item&#x2014;for example In stock, Out of stock, Pre-order, etc.';
    public const LABEL = 'availability';
    public const NAME = 'schema:availability';
    public const VALUES = ['ItemAvailabilityModel' => 'SchemaOrg\\Type\\ItemAvailabilityModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\\Type\\DemandModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel'];
}
