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

final class MuscleActionModel
{
    public const DESCRIPTION = 'The movement the muscle generates.';
    public const LABEL = 'muscleAction';
    public const NAME = 'schema:muscleAction';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['Muscle' => 'SchemaOrg\Type\MuscleModel'];
}
