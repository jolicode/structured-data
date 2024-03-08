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

final class EpisodesModel
{
    public const DESCRIPTION = 'An episode of a TV/radio series or season.';
    public const LABEL = 'episodes';
    public const NAME = 'schema:episodes';
    public const VALUES = ['EpisodeModel' => 'SchemaOrg\Type\EpisodeModel'];
    public const TYPES = ['CreativeWorkSeason' => 'SchemaOrg\Type\CreativeWorkSeasonModel', 'RadioSeries' => 'SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'SchemaOrg\Type\VideoGameSeriesModel'];
}
