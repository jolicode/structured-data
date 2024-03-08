<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class InsertionModel
{
    public const DESCRIPTION = 'The place of attachment of a muscle, or what the muscle moves.';
    public const LABEL = 'insertion';
    public const NAME = 'schema:insertion';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['Muscle' => 'SchemaOrg\Type\MuscleModel'];
}
