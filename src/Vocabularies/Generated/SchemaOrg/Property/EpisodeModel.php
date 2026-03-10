<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class EpisodeModel
{
    public const DESCRIPTION = 'An episode of a TV, radio or game media within a series or season.';
    public const LABEL = 'episode';
    public const NAME = 'schema:episode';
    public const VALUES = ['EpisodeModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EpisodeModel'];
    public const TYPES = ['CreativeWorkSeason' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkSeasonModel', 'RadioSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
