<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ProcedureTypeModel
{
    public const DESCRIPTION = 'The type of procedure, for example Surgical, Noninvasive, or Percutaneous.';
    public const LABEL = 'procedureType';
    public const NAME = 'schema:procedureType';
    public const VALUES = ['MedicalProcedureTypeModel' => 'SchemaOrg\Type\MedicalProcedureTypeModel'];
    public const TYPES = ['MedicalProcedure' => 'SchemaOrg\Type\MedicalProcedureModel'];
}
