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

final class LegislationDateVersionModel
{
    public const DESCRIPTION = 'The point-in-time at which the provided description of the legislation is valid (e.g.: when looking at the law on the 2016-04-07 (= dateVersion), I get the consolidation of 2015-04-12 of the "National Insurance Contributions Act 2015")';
    public const LABEL = 'legislationDateVersion';
    public const NAME = 'schema:legislationDateVersion';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel'];
    public const TYPES = ['Legislation' => 'Jolicode\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
