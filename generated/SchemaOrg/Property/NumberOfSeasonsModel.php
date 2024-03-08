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

final class NumberOfSeasonsModel
{
    public const DESCRIPTION = 'The number of seasons in this series.';
    public const LABEL = 'numberOfSeasons';
    public const NAME = 'schema:numberOfSeasons';
    public const VALUES = ['IntegerModel' => 'SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['RadioSeries' => 'SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'SchemaOrg\Type\VideoGameSeriesModel'];
}
