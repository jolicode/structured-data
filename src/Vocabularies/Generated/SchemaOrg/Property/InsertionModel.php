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

final class InsertionModel
{
    public const DESCRIPTION = 'The place of attachment of a muscle, or what the muscle moves.';
    public const LABEL = 'insertion';
    public const NAME = 'schema:insertion';
    public const VALUES = ['AnatomicalStructureModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['Muscle' => 'Jolicode\Vocabularies\SchemaOrg\Type\MuscleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
