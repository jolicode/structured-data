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

final class DoseScheduleModel
{
    public const DESCRIPTION = 'A dosing schedule for the drug for a given population, either observed, recommended, or maximum dose based on the type used.';
    public const LABEL = 'doseSchedule';
    public const NAME = 'schema:doseSchedule';
    public const VALUES = ['DoseScheduleModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DoseScheduleModel'];
    public const TYPES = ['Drug' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DrugModel', 'TherapeuticProcedure' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TherapeuticProcedureModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
