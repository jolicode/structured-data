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

final class PreparationModel
{
    public const DESCRIPTION = 'Typical preparation that a patient must undergo before having the procedure performed.';
    public const LABEL = 'preparation';
    public const NAME = 'schema:preparation';
    public const VALUES = ['MedicalEntityModel' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalProcedure' => 'Jolicode\SchemaOrg\Type\MedicalProcedureModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
