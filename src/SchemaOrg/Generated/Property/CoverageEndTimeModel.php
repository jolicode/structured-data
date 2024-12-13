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

final class CoverageEndTimeModel
{
    public const DESCRIPTION = 'The time when the live blog will stop covering the Event. Note that coverage may continue after the Event concludes.';
    public const LABEL = 'coverageEndTime';
    public const NAME = 'schema:coverageEndTime';
    public const VALUES = ['DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['LiveBlogPosting' => 'Jolicode\SchemaOrg\Type\LiveBlogPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
