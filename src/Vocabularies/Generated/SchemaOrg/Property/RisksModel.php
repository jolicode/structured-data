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

final class RisksModel
{
    public const DESCRIPTION = 'Specific physiologic risks associated to the diet plan.';
    public const LABEL = 'risks';
    public const NAME = 'schema:risks';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Diet' => 'Jolicode\Vocabularies\SchemaOrg\Type\DietModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
