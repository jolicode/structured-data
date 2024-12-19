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

final class DuplicateTherapyModel
{
    public const DESCRIPTION = 'A therapy that duplicates or overlaps this one.';
    public const LABEL = 'duplicateTherapy';
    public const NAME = 'schema:duplicateTherapy';
    public const VALUES = ['MedicalTherapyModel' => 'Jolicode\SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['MedicalTherapy' => 'Jolicode\SchemaOrg\Type\MedicalTherapyModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
