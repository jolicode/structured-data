<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class SodiumContentModel
{
    public const DESCRIPTION = 'The number of milligrams of sodium.';
    public const LABEL = 'sodiumContent';
    public const NAME = 'schema:sodiumContent';
    public const VALUES = ['MassModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MassModel'];
    public const TYPES = ['NutritionInformation' => 'Jolicode\Vocabularies\SchemaOrg\Type\NutritionInformationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
