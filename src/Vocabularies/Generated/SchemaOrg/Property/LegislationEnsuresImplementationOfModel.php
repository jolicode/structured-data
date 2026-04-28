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

final class LegislationEnsuresImplementationOfModel
{
    public const DESCRIPTION = 'Indicates that this Legislation ensures the implementation of another Legislation, for example by modifying national legislations so that they do not contradict to an EU regulation or decision. This implies a legal meaning. Transpositions of EU Directive should be captured with <a href="/legislationTransposes">legislationTransposes</a>.';
    public const LABEL = 'legislationEnsuresImplementationOf';
    public const NAME = 'schema:legislationEnsuresImplementationOf';
    public const VALUES = ['LegislationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const TYPES = ['Legislation' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LegislationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
