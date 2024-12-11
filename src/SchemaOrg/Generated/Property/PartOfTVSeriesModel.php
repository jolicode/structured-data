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

final class PartOfTVSeriesModel
{
    public const DESCRIPTION = 'The TV series to which this episode or season belongs.';
    public const LABEL = 'partOfTVSeries';
    public const NAME = 'schema:partOfTVSeries';
    public const VALUES = ['TVSeriesModel' => 'Jolicode\SchemaOrg\Type\TVSeriesModel'];
    public const TYPES = ['TVClip' => 'Jolicode\SchemaOrg\Type\TVClipModel', 'TVEpisode' => 'Jolicode\SchemaOrg\Type\TVEpisodeModel', 'TVSeason' => 'Jolicode\SchemaOrg\Type\TVSeasonModel'];
}
