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

final class AvailabilityEndsModel
{
    public const DESCRIPTION = 'The end of the availability of the product or service included in the offer.';
    public const LABEL = 'availabilityEnds';
    public const NAME = 'schema:availabilityEnds';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel', 'TimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TimeModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ActionAccessSpecificationModel', 'Demand' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1741'];
    public const SUPERSEDED_BY = null;
}
