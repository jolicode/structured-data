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

final class RecommendedIntakeModel
{
    public const DESCRIPTION = 'Recommended intake of this supplement for a given population as defined by a specific recommending authority.';
    public const LABEL = 'recommendedIntake';
    public const NAME = 'schema:recommendedIntake';
    public const VALUES = ['RecommendedDoseScheduleModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\RecommendedDoseScheduleModel'];
    public const TYPES = ['DietarySupplement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DietarySupplementModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
