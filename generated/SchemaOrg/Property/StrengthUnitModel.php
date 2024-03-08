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

final class StrengthUnitModel
{
    public const DESCRIPTION = 'The units of an active ingredient\'s strength, e.g. mg.';
    public const LABEL = 'strengthUnit';
    public const NAME = 'schema:strengthUnit';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['DrugStrength' => 'SchemaOrg\\Type\\DrugStrengthModel'];
}
