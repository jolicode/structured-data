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

final class StrengthValueModel
{
    public const DESCRIPTION = 'The value of an active ingredient\'s strength, e.g. 325.';
    public const LABEL = 'strengthValue';
    public const NAME = 'schema:strengthValue';
    public const VALUES = ['NumberModel' => 'SchemaOrg\Type\NumberModel'];
    public const TYPES = ['DrugStrength' => 'SchemaOrg\Type\DrugStrengthModel'];
}
