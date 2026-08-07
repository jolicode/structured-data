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

final class NumberOfCreditsModel
{
    public const DESCRIPTION = 'The number of credits or units awarded by a Course or required to complete an EducationalOccupationalProgram.';
    public const LABEL = 'numberOfCredits';
    public const NAME = 'schema:numberOfCredits';
    public const VALUES = ['IntegerModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IntegerModel', 'StructuredValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\StructuredValueModel'];
    public const TYPES = ['Course' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CourseModel', 'EducationalOccupationalProgram' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2419'];
    public const SUPERSEDED_BY = null;
}
