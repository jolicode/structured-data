<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class HasSponsorshipOfferModel
{
    public const DESCRIPTION = 'An offer to sponsor the event, for example, Sponsorship Prospectus, Sponsorship Opportunities, or Sponsor Packages.';
    public const LABEL = 'hasSponsorshipOffer';
    public const NAME = 'schema:hasSponsorshipOffer';
    public const VALUES = ['OfferModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const TYPES = ['Event' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/4495'];
    public const SUPERSEDED_BY = null;
}
