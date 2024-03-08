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

final class TransFatContentModel
{
    public const DESCRIPTION = 'The number of grams of trans fat.';
    public const LABEL = 'transFatContent';
    public const NAME = 'schema:transFatContent';
    public const VALUES = ['MassModel' => 'SchemaOrg\\Type\\MassModel'];
    public const TYPES = ['NutritionInformation' => 'SchemaOrg\\Type\\NutritionInformationModel'];
}
