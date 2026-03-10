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

final class BodyLocationModel
{
    public const DESCRIPTION = 'Location in the body of the anatomical structure.';
    public const LABEL = 'bodyLocation';
    public const NAME = 'schema:bodyLocation';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['AnatomicalStructure' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalStructureModel', 'MedicalProcedure' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalProcedureModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
