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

final class SaturatedFatContentModel
{
    public const DESCRIPTION = 'The number of grams of saturated fat.';
    public const LABEL = 'saturatedFatContent';
    public const NAME = 'schema:saturatedFatContent';
    public const VALUES = ['MassModel' => 'Jolicode\SchemaOrg\Type\MassModel'];
    public const TYPES = ['NutritionInformation' => 'Jolicode\SchemaOrg\Type\NutritionInformationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
