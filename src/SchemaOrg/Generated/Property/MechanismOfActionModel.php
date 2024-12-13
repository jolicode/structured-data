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

final class MechanismOfActionModel
{
    public const DESCRIPTION = 'The specific biochemical interaction through which this drug or supplement produces its pharmacological effect.';
    public const LABEL = 'mechanismOfAction';
    public const NAME = 'schema:mechanismOfAction';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'Jolicode\SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
