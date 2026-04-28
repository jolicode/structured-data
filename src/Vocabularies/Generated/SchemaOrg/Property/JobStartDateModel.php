<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class JobStartDateModel
{
    public const DESCRIPTION = 'The date on which a successful applicant for this job would be expected to start work. Choose a specific date in the future or use the jobImmediateStart property to indicate the position is to be filled as soon as possible.';
    public const LABEL = 'jobStartDate';
    public const NAME = 'schema:jobStartDate';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
