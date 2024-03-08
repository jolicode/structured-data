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

final class CaloriesModel
{
    public const DESCRIPTION = 'The number of calories.';
    public const LABEL = 'calories';
    public const NAME = 'schema:calories';
    public const VALUES = ['EnergyModel' => 'SchemaOrg\\Type\\EnergyModel'];
    public const TYPES = ['NutritionInformation' => 'SchemaOrg\\Type\\NutritionInformationModel'];
}
