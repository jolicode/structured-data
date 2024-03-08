<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class AvailabilityStartsModel
{
    public const DESCRIPTION = 'The beginning of the availability of the product or service included in the offer.';
    public const LABEL = 'availabilityStarts';
    public const NAME = 'schema:availabilityStarts';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel', 'DateTimeModel' => 'SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'SchemaOrg\Type\TimeModel'];
    public const TYPES = ['ActionAccessSpecification' => 'SchemaOrg\Type\ActionAccessSpecificationModel', 'Demand' => 'SchemaOrg\Type\DemandModel', 'Offer' => 'SchemaOrg\Type\OfferModel'];
}
