<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ProductionCompanyModel
{
    public const DESCRIPTION = 'The production company or studio responsible for the item, e.g. series, video game, episode etc.';
    public const LABEL = 'productionCompany';
    public const NAME = 'schema:productionCompany';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel'];
    public const TYPES = ['CreativeWorkSeason' => 'SchemaOrg\\Type\\CreativeWorkSeasonModel', 'Episode' => 'SchemaOrg\\Type\\EpisodeModel', 'MediaObject' => 'SchemaOrg\\Type\\MediaObjectModel', 'Movie' => 'SchemaOrg\\Type\\MovieModel', 'MovieSeries' => 'SchemaOrg\\Type\\MovieSeriesModel', 'RadioSeries' => 'SchemaOrg\\Type\\RadioSeriesModel', 'TVSeries' => 'SchemaOrg\\Type\\TVSeriesModel', 'VideoGameSeries' => 'SchemaOrg\\Type\\VideoGameSeriesModel'];
}
