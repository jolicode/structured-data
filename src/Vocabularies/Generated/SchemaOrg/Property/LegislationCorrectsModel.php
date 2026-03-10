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

final class LegislationCorrectsModel
{
    public const DESCRIPTION = 'Another legislation in which this one introduces textual changes, like correction of spelling mistakes, with no legal impact (for modifications that have legal impact, use <a href="/legislationAmends">legislationAmends</a>).';
    public const LABEL = 'legislationCorrects';
    public const NAME = 'schema:legislationCorrects';
    public const VALUES = ['LegislationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\LegislationModel'];
    public const TYPES = ['Legislation' => 'Jolicode\Vocabularies\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
