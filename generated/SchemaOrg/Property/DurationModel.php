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

final class DurationModel
{
    public const DESCRIPTION = 'The duration of the item (movie, audio recording, event, etc.) in [ISO 8601 date format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'duration';
    public const NAME = 'schema:duration';
    public const VALUES = ['DurationModel' => 'SchemaOrg\Type\DurationModel'];
    public const TYPES = ['Audiobook' => 'SchemaOrg\Type\AudiobookModel', 'Episode' => 'SchemaOrg\Type\EpisodeModel', 'Event' => 'SchemaOrg\Type\EventModel', 'MediaObject' => 'SchemaOrg\Type\MediaObjectModel', 'Movie' => 'SchemaOrg\Type\MovieModel', 'MusicRecording' => 'SchemaOrg\Type\MusicRecordingModel', 'MusicRelease' => 'SchemaOrg\Type\MusicReleaseModel', 'QuantitativeValueDistribution' => 'SchemaOrg\Type\QuantitativeValueDistributionModel', 'Schedule' => 'SchemaOrg\Type\ScheduleModel'];
}
