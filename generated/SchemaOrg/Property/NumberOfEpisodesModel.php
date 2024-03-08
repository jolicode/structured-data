<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class NumberOfEpisodesModel
{
    public const DESCRIPTION = 'The number of episodes in this season or series.';
    public const LABEL = 'numberOfEpisodes';
    public const NAME = 'schema:numberOfEpisodes';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\\Type\\IntegerModel'];
    public const TYPES = ['CreativeWorkSeason' => 'SchemaOrg\\Type\\CreativeWorkSeasonModel', 'RadioSeries' => 'SchemaOrg\\Type\\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\\Type\\TVSeriesModel', 'VideoGameSeries' => 'SchemaOrg\\Type\\VideoGameSeriesModel'];
}
