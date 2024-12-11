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

final class UnsaturatedFatContentModel
{
    public const DESCRIPTION = 'The number of grams of unsaturated fat.';
    public const LABEL = 'unsaturatedFatContent';
    public const NAME = 'schema:unsaturatedFatContent';
    public const VALUES = ['MassModel' => 'Jolicode\SchemaOrg\Type\MassModel'];
    public const TYPES = ['NutritionInformation' => 'Jolicode\SchemaOrg\Type\NutritionInformationModel'];
}
