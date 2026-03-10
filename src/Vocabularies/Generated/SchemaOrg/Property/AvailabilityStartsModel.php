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

final class AvailabilityStartsModel
{
    public const DESCRIPTION = 'The beginning of the availability of the product or service included in the offer.';
    public const LABEL = 'availabilityStarts';
    public const NAME = 'schema:availabilityStarts';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\ActionAccessSpecificationModel', 'Demand' => 'Jolicode\Vocabularies\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
