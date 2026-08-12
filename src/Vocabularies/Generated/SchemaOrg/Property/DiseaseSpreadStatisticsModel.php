<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class DiseaseSpreadStatisticsModel
{
    public const DESCRIPTION = 'Statistical information about the spread of a disease, either as [[WebContent]], or
  described directly as a [[Dataset]], or the specific [[Observation]]s in the dataset. When a [[WebContent]] URL is
  provided, the page indicated might also contain more such markup.';
    public const LABEL = 'diseaseSpreadStatistics';
    public const NAME = 'schema:diseaseSpreadStatistics';
    public const VALUES = ['DatasetModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DatasetModel', 'ObservationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ObservationModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel', 'WebContentModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2490'];
    public const SUPERSEDED_BY = null;
}
