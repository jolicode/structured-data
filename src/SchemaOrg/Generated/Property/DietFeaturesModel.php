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

final class DietFeaturesModel
{
    public const DESCRIPTION = 'Nutritional information specific to the dietary plan. May include dietary recommendations on what foods to avoid, what foods to consume, and specific alterations/deviations from the USDA or other regulatory body\'s approved dietary guidelines.';
    public const LABEL = 'dietFeatures';
    public const NAME = 'schema:dietFeatures';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Diet' => 'Jolicode\SchemaOrg\Type\DietModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
