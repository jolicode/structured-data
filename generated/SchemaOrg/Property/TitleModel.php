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

final class TitleModel
{
    public const DESCRIPTION = 'The title of the job.';
    public const LABEL = 'title';
    public const NAME = 'schema:title';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\Type\JobPostingModel'];
}
