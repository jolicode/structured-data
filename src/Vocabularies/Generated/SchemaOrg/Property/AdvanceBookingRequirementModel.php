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

final class AdvanceBookingRequirementModel
{
    public const DESCRIPTION = 'The amount of time that is required between accepting the offer and the actual usage of the resource or service.';
    public const LABEL = 'advanceBookingRequirement';
    public const NAME = 'schema:advanceBookingRequirement';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
