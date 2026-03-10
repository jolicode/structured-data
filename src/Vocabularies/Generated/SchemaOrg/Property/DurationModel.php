<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class DurationModel
{
    public const DESCRIPTION = 'The duration of the item (movie, audio recording, event, etc.) in [ISO 8601 duration format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'duration';
    public const NAME = 'schema:duration';
    public const VALUES = ['DurationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DurationModel', 'QuantitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Audiobook' => 'Jolicode\Vocabularies\SchemaOrg\Type\AudiobookModel', 'Episode' => 'Jolicode\Vocabularies\SchemaOrg\Type\EpisodeModel', 'Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel', 'MediaObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel', 'Movie' => 'Jolicode\Vocabularies\SchemaOrg\Type\MovieModel', 'MusicRecording' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicRecordingModel', 'MusicRelease' => 'Jolicode\Vocabularies\SchemaOrg\Type\MusicReleaseModel', 'QuantitativeValueDistribution' => 'Jolicode\Vocabularies\SchemaOrg\Type\QuantitativeValueDistributionModel', 'Schedule' => 'Jolicode\Vocabularies\SchemaOrg\Type\ScheduleModel', 'ServicePeriod' => 'Jolicode\Vocabularies\SchemaOrg\Type\ServicePeriodModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
