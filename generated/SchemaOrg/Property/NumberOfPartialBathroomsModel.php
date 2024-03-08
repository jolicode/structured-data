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

final class NumberOfPartialBathroomsModel
{
    public const DESCRIPTION = 'Number of partial bathrooms - The total number of half and ¼ bathrooms in an [[Accommodation]]. This corresponds to the [BathroomsPartial field in RESO](https://ddwiki.reso.org/display/DDW17/BathroomsPartial+Field). ';
    public const LABEL = 'numberOfPartialBathrooms';
    public const NAME = 'schema:numberOfPartialBathrooms';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['Accommodation' => 'SchemaOrg\\Type\\AccommodationModel', 'FloorPlan' => 'SchemaOrg\\Type\\FloorPlanModel'];
}
