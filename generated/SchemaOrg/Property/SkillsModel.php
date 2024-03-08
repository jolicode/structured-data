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

final class SkillsModel
{
    public const DESCRIPTION = 'A statement of knowledge, skill, ability, task or any other assertion expressing a competency that is desired or required to fulfill this role or to work in this occupation.';
    public const LABEL = 'skills';
    public const NAME = 'schema:skills';
    public const VALUES = ['DefinedTermModel' => 'SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\Type\JobPostingModel', 'Occupation' => 'SchemaOrg\Type\OccupationModel'];
}
