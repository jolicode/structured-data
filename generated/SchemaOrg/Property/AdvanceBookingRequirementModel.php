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

final class AdvanceBookingRequirementModel
{
    public const DESCRIPTION = 'The amount of time that is required between accepting the offer and the actual usage of the resource or service.';
    public const LABEL = 'advanceBookingRequirement';
    public const NAME = 'schema:advanceBookingRequirement';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const TYPES = ['Demand' => 'SchemaOrg\\Type\\DemandModel', 'Offer' => 'SchemaOrg\\Type\\OfferModel'];
}
