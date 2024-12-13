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

final class RelevantOccupationModel
{
    public const DESCRIPTION = 'The Occupation for the JobPosting.';
    public const LABEL = 'relevantOccupation';
    public const NAME = 'schema:relevantOccupation';
    public const VALUES = ['OccupationModel' => 'Jolicode\SchemaOrg\Type\OccupationModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
