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

final class TotalJobOpeningsModel
{
    public const DESCRIPTION = 'The number of positions open for this job posting. Use a positive integer. Do not use if the number of positions is unclear or not known.';
    public const LABEL = 'totalJobOpenings';
    public const NAME = 'schema:totalJobOpenings';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['JobPosting' => 'Jolicode\SchemaOrg\Type\JobPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
