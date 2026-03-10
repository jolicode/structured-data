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

final class IsPlanForApartmentModel
{
    public const DESCRIPTION = 'Indicates some accommodation that this floor plan describes.';
    public const LABEL = 'isPlanForApartment';
    public const NAME = 'schema:isPlanForApartment';
    public const VALUES = ['AccommodationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AccommodationModel'];
    public const TYPES = ['FloorPlan' => 'Jolicode\Vocabularies\SchemaOrg\Type\FloorPlanModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
