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

final class OpponentModel
{
    public const DESCRIPTION = 'A sub property of participant. The opponent on this action.';
    public const LABEL = 'opponent';
    public const NAME = 'schema:opponent';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['ExerciseAction' => 'SchemaOrg\Type\ExerciseActionModel'];
}
