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

final class ActorsModel
{
    public const DESCRIPTION = 'An actor, e.g. in TV, radio, movie, video games etc. Actors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'actors';
    public const NAME = 'schema:actors';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Clip' => 'Jolicode\Vocabularies\SchemaOrg\Type\ClipModel', 'Episode' => 'Jolicode\Vocabularies\SchemaOrg\Type\EpisodeModel', 'Movie' => 'Jolicode\Vocabularies\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameSeriesModel', 'VideoObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
