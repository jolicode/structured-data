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

final class TypicalCreditsPerTermModel
{
    public const DESCRIPTION = 'The number of credits or units a full-time student would be expected to take in 1 term however \'term\' is defined by the institution.';
    public const LABEL = 'typicalCreditsPerTerm';
    public const NAME = 'schema:typicalCreditsPerTerm';
    public const VALUES = ['IntegerModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\IntegerModel', 'StructuredValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\StructuredValueModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2419'];
    public const SUPERSEDED_BY = null;
}
