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

final class MaximumIntakeModel
{
    public const DESCRIPTION = 'Recommended intake of this supplement for a given population as defined by a specific recommending authority.';
    public const LABEL = 'maximumIntake';
    public const NAME = 'schema:maximumIntake';
    public const VALUES = ['MaximumDoseScheduleModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MaximumDoseScheduleModel'];
    public const TYPES = ['DietarySupplement' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugModel', 'DrugStrength' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugStrengthModel', 'Substance' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SubstanceModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
