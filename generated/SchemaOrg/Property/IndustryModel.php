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

final class IndustryModel
{
    public const DESCRIPTION = 'The industry associated with the job position.';
    public const LABEL = 'industry';
    public const NAME = 'schema:industry';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\Type\JobPostingModel'];
}
