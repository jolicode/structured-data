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

final class AvailableAtOrFromModel
{
    public const DESCRIPTION = 'The place(s) from which the offer can be obtained (e.g. store locations).';
    public const LABEL = 'availableAtOrFrom';
    public const NAME = 'schema:availableAtOrFrom';
    public const VALUES = ['PlaceModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['Demand' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
