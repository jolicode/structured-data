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

final class DiseaseSpreadStatisticsModel
{
    public const DESCRIPTION = 'Statistical information about the spread of a disease, either as [[WebContent]], or
  described directly as a [[Dataset]], or the specific [[Observation]]s in the dataset. When a [[WebContent]] URL is
  provided, the page indicated might also contain more such markup.';
    public const LABEL = 'diseaseSpreadStatistics';
    public const NAME = 'schema:diseaseSpreadStatistics';
    public const VALUES = ['DatasetModel' => 'Jolicode\SchemaOrg\Type\DatasetModel', 'ObservationModel' => 'Jolicode\SchemaOrg\Type\ObservationModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel', 'WebContentModel' => 'Jolicode\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'Jolicode\SchemaOrg\Type\SpecialAnnouncementModel'];
}
