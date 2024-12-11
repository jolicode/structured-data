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

final class CaloriesModel
{
    public const DESCRIPTION = 'The number of calories.';
    public const LABEL = 'calories';
    public const NAME = 'schema:calories';
    public const VALUES = ['EnergyModel' => 'Jolicode\SchemaOrg\Type\EnergyModel'];
    public const TYPES = ['NutritionInformation' => 'Jolicode\SchemaOrg\Type\NutritionInformationModel'];
}
