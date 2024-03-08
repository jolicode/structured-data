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

final class JobLocationTypeModel
{
    public const DESCRIPTION = 'A description of the job location (e.g. TELECOMMUTE for telecommute jobs).';
    public const LABEL = 'jobLocationType';
    public const NAME = 'schema:jobLocationType';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\Type\JobPostingModel'];
}
