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

final class ContainsSeasonModel
{
    public const DESCRIPTION = 'A season that is part of the media series.';
    public const LABEL = 'containsSeason';
    public const NAME = 'schema:containsSeason';
    public const VALUES = ['CreativeWorkSeasonModel' => 'SchemaOrg\Type\CreativeWorkSeasonModel'];
    public const TYPES = ['RadioSeries' => 'SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'SchemaOrg\Type\VideoGameSeriesModel'];
}
