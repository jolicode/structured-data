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

final class SeasonsModel
{
    public const DESCRIPTION = 'A season in a media series.';
    public const LABEL = 'seasons';
    public const NAME = 'schema:seasons';
    public const VALUES = ['CreativeWorkSeasonModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkSeasonModel'];
    public const TYPES = ['RadioSeries' => 'Jolicode\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
