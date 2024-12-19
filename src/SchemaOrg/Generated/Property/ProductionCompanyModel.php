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

final class ProductionCompanyModel
{
    public const DESCRIPTION = 'The production company or studio responsible for the item, e.g. series, video game, episode etc.';
    public const LABEL = 'productionCompany';
    public const NAME = 'schema:productionCompany';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['CreativeWorkSeason' => 'Jolicode\SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'Jolicode\SchemaOrg\Type\EpisodeModel', 'MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'Movie' => 'Jolicode\SchemaOrg\Type\MovieModel', 'MovieSeries' => 'Jolicode\SchemaOrg\Type\MovieSeriesModel', 'RadioSeries' => 'Jolicode\SchemaOrg\Type\RadioSeriesModel', 'TVSeries' => 'Jolicode\SchemaOrg\Type\TVSeriesModel', 'VideoGameSeries' => 'Jolicode\SchemaOrg\Type\VideoGameSeriesModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
