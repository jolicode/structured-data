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

final class ProductionCompanyModel
{
    public const DESCRIPTION = 'The production company or studio responsible for the item, e.g. series, video game, episode etc.';
    public const LABEL = 'productionCompany';
    public const NAME = 'schema:productionCompany';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['CreativeWorkSeason' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'Jolicode\Vocabularies\SchemaOrg\Type\EpisodeModel', 'MediaObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel', 'Movie' => 'Jolicode\Vocabularies\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'Jolicode\Vocabularies\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
