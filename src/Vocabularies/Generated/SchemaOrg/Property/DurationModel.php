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

final class DurationModel
{
    public const DESCRIPTION = 'The duration of the item (movie, audio recording, event, etc.) in [ISO 8601 duration format](http://en.wikipedia.org/wiki/ISO_8601).';
    public const LABEL = 'duration';
    public const NAME = 'schema:duration';
    public const VALUES = ['DurationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DurationModel', 'QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Audiobook' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AudiobookModel', 'Episode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EpisodeModel', 'Event' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EventModel', 'MediaObject' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MediaObjectModel', 'Movie' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MovieModel', 'MusicRecording' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MusicRecordingModel', 'MusicRelease' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MusicReleaseModel', 'QuantitativeValueDistribution' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueDistributionModel', 'Schedule' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ScheduleModel', 'ServicePeriod' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ServicePeriodModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1457', 'https://github.com/schemaorg/schemaorg/issues/1698', 'https://github.com/schemaorg/schemaorg/issues/3617'];
    public const SUPERSEDED_BY = null;
}
