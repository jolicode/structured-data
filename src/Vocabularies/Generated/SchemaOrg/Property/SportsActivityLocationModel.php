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

final class SportsActivityLocationModel
{
    public const DESCRIPTION = 'A sub property of location. The sports activity location where this action occurred.';
    public const LABEL = 'sportsActivityLocation';
    public const NAME = 'schema:sportsActivityLocation';
    public const VALUES = ['SportsActivityLocationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\SportsActivityLocationModel'];
    public const TYPES = ['ExerciseAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\ExerciseActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
