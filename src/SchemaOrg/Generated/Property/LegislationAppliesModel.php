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

final class LegislationAppliesModel
{
    public const DESCRIPTION = 'Indicates that this legislation (or part of a legislation) somehow transfers another legislation in a different legislative context. This is an informative link, and it has no legal value. For legally-binding links of transposition, use the <a href="/legislationTransposes">legislationTransposes</a> property. For example an informative consolidated law of a European Union\'s member state "applies" the consolidated version of the European Directive implemented in it.';
    public const LABEL = 'legislationApplies';
    public const NAME = 'schema:legislationApplies';
    public const VALUES = ['LegislationModel' => 'Jolicode\SchemaOrg\Type\LegislationModel'];
    public const TYPES = ['Legislation' => 'Jolicode\SchemaOrg\Type\LegislationModel'];
}
