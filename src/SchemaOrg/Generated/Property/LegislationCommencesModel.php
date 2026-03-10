<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class LegislationCommencesModel
{
    public const DESCRIPTION = 'Another legislation that this one sets into force.';
    public const LABEL = 'legislationCommences';
    public const NAME = 'schema:legislationCommences';
    public const VALUES = ['LegislationModel' => 'Jolicode\SchemaOrg\Type\LegislationModel'];
    public const TYPES = ['Legislation' => 'Jolicode\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
