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

final class StrengthValueModel
{
    public const DESCRIPTION = 'The value of an active ingredient\'s strength, e.g. 325.';
    public const LABEL = 'strengthValue';
    public const NAME = 'schema:strengthValue';
    public const VALUES = ['NumberModel' => 'Jolicode\SchemaOrg\Type\NumberModel'];
    public const TYPES = ['DrugStrength' => 'Jolicode\SchemaOrg\Type\DrugStrengthModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
