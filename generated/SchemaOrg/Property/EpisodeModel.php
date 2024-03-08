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

final class EpisodeModel
{
    public const DESCRIPTION = 'An episode of a TV, radio or game media within a series or season.';
    public const LABEL = 'episode';
    public const NAME = 'schema:episode';
    public const VALUES = ['EpisodeModel' => 'SchemaOrg\Type\EpisodeModel'];
    public const TYPES = ['CreativeWorkSeason' => 'SchemaOrg\Type\CreativeWorkSeasonModel', 'RadioSeries' => 'SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'SchemaOrg\Type\VideoGameSeriesModel'];
}
