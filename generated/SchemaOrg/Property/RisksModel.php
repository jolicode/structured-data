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

final class RisksModel
{
    public const DESCRIPTION = 'Specific physiologic risks associated to the diet plan.';
    public const LABEL = 'risks';
    public const NAME = 'schema:risks';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Diet' => 'SchemaOrg\Type\DietModel'];
}
