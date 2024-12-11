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

final class WorkHoursModel
{
    public const DESCRIPTION = 'The typical working hours for this job (e.g. 1st shift, night shift, 8am-5pm).';
    public const LABEL = 'workHours';
    public const NAME = 'schema:workHours';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel'];
}
