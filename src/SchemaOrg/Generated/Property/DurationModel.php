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

final class DurationModel
{
    public const DESCRIPTION = 'The duration of the item (movie, audio recording, event, etc.) in [ISO 8601 duration format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'duration';
    public const NAME = 'schema:duration';
    public const VALUES = ['DurationModel' => 'Jolicode\SchemaOrg\Type\DurationModel'];
    public const TYPES = ['Audiobook' => 'Jolicode\SchemaOrg\Type\AudiobookModel', 'Episode' => 'Jolicode\SchemaOrg\Type\EpisodeModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'Movie' => 'Jolicode\SchemaOrg\Type\MovieModel', 'MusicRecording' => 'Jolicode\SchemaOrg\Type\MusicRecordingModel', 'MusicRelease' => 'Jolicode\SchemaOrg\Type\MusicReleaseModel', 'QuantitativeValueDistribution' => 'Jolicode\SchemaOrg\Type\QuantitativeValueDistributionModel', 'Schedule' => 'Jolicode\SchemaOrg\Type\ScheduleModel'];
}
