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

final class ApplicationStartDateModel
{
    public const DESCRIPTION = 'The date at which the program begins collecting applications for the next enrollment cycle.';
    public const LABEL = 'applicationStartDate';
    public const NAME = 'schema:applicationStartDate';
    public const VALUES = ['DateModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2419'];
    public const SUPERSEDED_BY = null;
}
