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

final class HasSponsorshipOfferModel
{
    public const DESCRIPTION = 'An offer to sponsor the event, for example, Sponsorship Prospectus, Sponsorship Opportunities, or Sponsor Packages.';
    public const LABEL = 'hasSponsorshipOffer';
    public const NAME = 'schema:hasSponsorshipOffer';
    public const VALUES = ['OfferModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel'];
    public const TYPES = ['Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
