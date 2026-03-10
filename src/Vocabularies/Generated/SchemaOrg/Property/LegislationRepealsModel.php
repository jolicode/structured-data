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

final class LegislationRepealsModel
{
    public const DESCRIPTION = 'Another legislation that this legislation repeals (cancels, abrogates).';
    public const LABEL = 'legislationRepeals';
    public const NAME = 'schema:legislationRepeals';
    public const VALUES = ['LegislationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\LegislationModel'];
    public const TYPES = ['Legislation' => 'Jolicode\Vocabularies\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
