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

final class DoseScheduleModel
{
    public const DESCRIPTION = 'A dosing schedule for the drug for a given population, either observed, recommended, or maximum dose based on the type used.';
    public const LABEL = 'doseSchedule';
    public const NAME = 'schema:doseSchedule';
    public const VALUES = ['DoseScheduleModel' => 'SchemaOrg\\Type\\DoseScheduleModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\\Type\\DrugModel', 'TherapeuticProcedure' => 'SchemaOrg\\Type\\TherapeuticProcedureModel'];
}
