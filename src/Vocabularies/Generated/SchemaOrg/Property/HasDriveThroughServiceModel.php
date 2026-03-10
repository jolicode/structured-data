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

final class HasDriveThroughServiceModel
{
    public const DESCRIPTION = 'Indicates whether some facility (e.g. [[FoodEstablishment]], [[CovidTestingFacility]]) offers a service that can be used by driving through in a car. In the case of [[CovidTestingFacility]] such facilities could potentially help with social distancing from other potentially-infected users.';
    public const LABEL = 'hasDriveThroughService';
    public const NAME = 'schema:hasDriveThroughService';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['Place' => 'Jolicode\Vocabularies\SchemaOrg\Type\PlaceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
