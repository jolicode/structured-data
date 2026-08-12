<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class CoverageEndTimeModel
{
    public const DESCRIPTION = 'The time when the live blog will stop covering the Event. Note that coverage may continue after the Event concludes.';
    public const LABEL = 'coverageEndTime';
    public const NAME = 'schema:coverageEndTime';
    public const VALUES = ['DateTimeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['LiveBlogPosting' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\LiveBlogPostingModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
