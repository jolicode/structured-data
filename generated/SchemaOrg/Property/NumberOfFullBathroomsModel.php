<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class NumberOfFullBathroomsModel
{
    public const DESCRIPTION = 'Number of full bathrooms - The total number of full and ¾ bathrooms in an [[Accommodation]]. This corresponds to the [BathroomsFull field in RESO](https://ddwiki.reso.org/display/DDW17/BathroomsFull+Field).';
    public const LABEL = 'numberOfFullBathrooms';
    public const NAME = 'schema:numberOfFullBathrooms';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\\Type\\AccommodationModel', 'FloorPlan' => 'SchemaOrg\\Type\\FloorPlanModel'];
}
