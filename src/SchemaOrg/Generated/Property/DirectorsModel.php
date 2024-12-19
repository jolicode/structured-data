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

final class DirectorsModel
{
    public const DESCRIPTION = 'A director of e.g. TV, radio, movie, video games etc. content. Directors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'directors';
    public const NAME = 'schema:directors';
    public const VALUES = ['PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Clip' => 'Jolicode\SchemaOrg\Type\ClipModel', 'Episode' => 'Jolicode\SchemaOrg\Type\EpisodeModel', 'Movie' => 'Jolicode\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'Jolicode\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'Jolicode\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'Jolicode\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel', 'VideoObject' => 'Jolicode\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
