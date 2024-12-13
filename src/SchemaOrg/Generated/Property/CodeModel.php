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

final class CodeModel
{
    public const DESCRIPTION = 'A medical code for the entity, taken from a controlled vocabulary or ontology such as ICD-9, DiseasesDB, MeSH, SNOMED-CT, RxNorm, etc.';
    public const LABEL = 'code';
    public const NAME = 'schema:code';
    public const VALUES = ['MedicalCodeModel' => 'Jolicode\SchemaOrg\Type\MedicalCodeModel'];
    public const TYPES = ['MedicalEntity' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
