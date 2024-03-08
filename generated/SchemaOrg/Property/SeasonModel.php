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

final class SeasonModel
{
    public const DESCRIPTION = 'A season in a media series.';
    public const LABEL = 'season';
    public const NAME = 'schema:season';
    public const VALUES = ['CreativeWorkSeasonModel' => 'SchemaOrg\\Type\\CreativeWorkSeasonModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['RadioSeries' => 'SchemaOrg\\Type\\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\\Type\\TVSeriesModel', 'VideoGameSeries' => 'SchemaOrg\\Type\\VideoGameSeriesModel'];
}
