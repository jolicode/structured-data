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

final class SkillsModel
{
    public const DESCRIPTION = 'A statement of knowledge, skill, ability, task or any other assertion expressing a competency that is either claimed by a person, an organization or desired or required to fulfill a role or to work in an occupation.';
    public const LABEL = 'skills';
    public const NAME = 'schema:skills';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel', 'Occupation' => 'Jolicode\SchemaOrg\Type\OccupationModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
