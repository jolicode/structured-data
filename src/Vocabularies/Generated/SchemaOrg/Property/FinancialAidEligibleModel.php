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

final class FinancialAidEligibleModel
{
    public const DESCRIPTION = 'A financial aid type or program which students may use to pay for tuition or fees associated with the program.';
    public const LABEL = 'financialAidEligible';
    public const NAME = 'schema:financialAidEligible';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Course' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CourseModel', 'EducationalOccupationalProgram' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2418'];
    public const SUPERSEDED_BY = null;
}
