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

final class RepeatFrequencyModel
{
    public const DESCRIPTION = 'Defines the frequency at which [[Event]]s will occur according to a schedule [[Schedule]]. The intervals between
      events should be defined as a [[Duration]] of time.';
    public const LABEL = 'repeatFrequency';
    public const NAME = 'schema:repeatFrequency';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DurationModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Schedule' => 'Jolicode\Vocabularies\SchemaOrg\Type\ScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
