<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class FloorSizeModel
{
    public const DESCRIPTION = 'The size of the accommodation, e.g. in square meter or squarefoot.
Typical unit code(s): MTK for square meter, FTK for square foot, or YDK for square yard ';
    public const LABEL = 'floorSize';
    public const NAME = 'schema:floorSize';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Accommodation' => 'Jolicode\SchemaOrg\Type\AccommodationModel', 'FloorPlan' => 'Jolicode\SchemaOrg\Type\FloorPlanModel'];
}
