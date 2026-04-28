<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class DirectorsModel
{
    public const DESCRIPTION = 'A director of e.g. TV, radio, movie, video games etc. content. Directors can be associated with individual items or with a series, episode, clip.';
    public const LABEL = 'directors';
    public const NAME = 'schema:directors';
    public const VALUES = ['PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Clip' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ClipModel', 'Episode' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EpisodeModel', 'Movie' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TVSeriesModel', 'VideoGame' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VideoGameModel', 'VideoGameSeries' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VideoGameSeriesModel', 'VideoObject' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VideoObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
