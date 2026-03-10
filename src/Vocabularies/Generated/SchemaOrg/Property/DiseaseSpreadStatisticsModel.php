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

final class DiseaseSpreadStatisticsModel
{
    public const DESCRIPTION = 'Statistical information about the spread of a disease, either as [[WebContent]], or
  described directly as a [[Dataset]], or the specific [[Observation]]s in the dataset. When a [[WebContent]] URL is
  provided, the page indicated might also contain more such markup.';
    public const LABEL = 'diseaseSpreadStatistics';
    public const NAME = 'schema:diseaseSpreadStatistics';
    public const VALUES = ['DatasetModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\DatasetModel', 'ObservationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ObservationModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel', 'WebContentModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'Jolicode\Vocabularies\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
