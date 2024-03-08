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

final class DirectorsModel
{
    public const DESCRIPTION = 'A director of e.g. TV, radio, movie, video games etc. content. Directors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'directors';
    public const NAME = 'schema:directors';
    public const VALUES = ['PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Clip' => 'SchemaOrg\Type\ClipModel', 'Episode' => 'SchemaOrg\Type\EpisodeModel', 'Movie' => 'SchemaOrg\Type\MovieModel', 'MovieSeries' => 'SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'SchemaOrg\Type\VideoGameSeriesModel', 'VideoObject' => 'SchemaOrg\Type\VideoObjectModel'];
}
