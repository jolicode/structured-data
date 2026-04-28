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

final class LegislationDateOfApplicabilityModel
{
    public const DESCRIPTION = 'The date at which the Legislation becomes applicable. This can sometimes be distinct from the date of entry into force : a text may come in force today, and state it will become applicable in 3 months.';
    public const LABEL = 'legislationDateOfApplicability';
    public const NAME = 'schema:legislationDateOfApplicability';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Legislation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
