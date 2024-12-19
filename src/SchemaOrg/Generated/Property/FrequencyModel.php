<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class FrequencyModel
{
    public const DESCRIPTION = 'How often the dose is taken, e.g. \'daily\'.';
    public const LABEL = 'frequency';
    public const NAME = 'schema:frequency';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DoseSchedule' => 'Jolicode\SchemaOrg\Type\DoseScheduleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
