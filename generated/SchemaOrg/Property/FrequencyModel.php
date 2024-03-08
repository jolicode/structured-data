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

final class FrequencyModel
{
    public const DESCRIPTION = 'How often the dose is taken, e.g. \'daily\'.';
    public const LABEL = 'frequency';
    public const NAME = 'schema:frequency';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['DoseSchedule' => 'SchemaOrg\\Type\\DoseScheduleModel'];
}
