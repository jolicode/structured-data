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

final class StrengthUnitModel
{
    public const DESCRIPTION = 'The units of an active ingredient\'s strength, e.g. mg.';
    public const LABEL = 'strengthUnit';
    public const NAME = 'schema:strengthUnit';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DrugStrength' => 'Jolicode\SchemaOrg\Type\DrugStrengthModel'];
}
