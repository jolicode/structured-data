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

final class OfferedByModel
{
    public const DESCRIPTION = 'A pointer to the organization or person making the offer.';
    public const LABEL = 'offeredBy';
    public const NAME = 'schema:offeredBy';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Offer' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
