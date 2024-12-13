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

final class AvailabilityEndsModel
{
    public const DESCRIPTION = 'The end of the availability of the product or service included in the offer.';
    public const LABEL = 'availabilityEnds';
    public const NAME = 'schema:availabilityEnds';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'Jolicode\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\SchemaOrg\Type\ActionAccessSpecificationModel', 'Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
