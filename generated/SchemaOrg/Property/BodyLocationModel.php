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

final class BodyLocationModel
{
    public const DESCRIPTION = 'Location in the body of the anatomical structure.';
    public const LABEL = 'bodyLocation';
    public const NAME = 'schema:bodyLocation';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['AnatomicalStructure' => 'SchemaOrg\Type\AnatomicalStructureModel', 'MedicalProcedure' => 'SchemaOrg\Type\MedicalProcedureModel'];
}
