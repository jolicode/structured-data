<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class MealServiceModel
{
    public const DESCRIPTION = 'Description of the meals that will be provided or available for purchase.';
    public const LABEL = 'mealService';
    public const NAME = 'schema:mealService';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Flight' => 'SchemaOrg\Type\FlightModel'];
}
