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

final class PartOfSeriesModel
{
    public const DESCRIPTION = 'The series to which this episode or season belongs.';
    public const LABEL = 'partOfSeries';
    public const NAME = 'schema:partOfSeries';
    public const VALUES = ['CreativeWorkSeriesModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkSeriesModel'];
    public const TYPES = ['Clip' => 'Jolicode\SchemaOrg\Type\ClipModel', 'CreativeWorkSeason' => 'Jolicode\SchemaOrg\Type\CreativeWorkSeasonModel', 'Episode' => 'Jolicode\SchemaOrg\Type\EpisodeModel'];
}
