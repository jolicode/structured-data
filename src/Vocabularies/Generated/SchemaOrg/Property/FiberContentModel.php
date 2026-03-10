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

final class FiberContentModel
{
    public const DESCRIPTION = 'The number of grams of fiber.';
    public const LABEL = 'fiberContent';
    public const NAME = 'schema:fiberContent';
    public const VALUES = ['MassModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MassModel'];
    public const TYPES = ['NutritionInformation' => 'Jolicode\Vocabularies\SchemaOrg\Type\NutritionInformationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
