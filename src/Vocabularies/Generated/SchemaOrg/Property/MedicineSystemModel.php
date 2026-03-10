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

final class MedicineSystemModel
{
    public const DESCRIPTION = 'The system of medicine that includes this MedicalEntity, for example \'evidence-based\', \'homeopathic\', \'chiropractic\', etc.';
    public const LABEL = 'medicineSystem';
    public const NAME = 'schema:medicineSystem';
    public const VALUES = ['MedicineSystemModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicineSystemModel'];
    public const TYPES = ['MedicalEntity' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
