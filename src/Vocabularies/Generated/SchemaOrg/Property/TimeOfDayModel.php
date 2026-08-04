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

final class TimeOfDayModel
{
    public const DESCRIPTION = 'The time of day the program normally runs. For example, "evenings".';
    public const LABEL = 'timeOfDay';
    public const NAME = 'schema:timeOfDay';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['EducationalOccupationalProgram' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\EducationalOccupationalProgramModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2419'];
    public const SUPERSEDED_BY = null;
}
