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

final class HasParticipationOfferModel
{
    public const DESCRIPTION = 'An offer to participate in the event, for example, Call for Proposals, Call for Speakers, or Call for Performers.';
    public const LABEL = 'hasParticipationOffer';
    public const NAME = 'schema:hasParticipationOffer';
    public const VALUES = ['OfferModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OfferModel'];
    public const TYPES = ['Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
