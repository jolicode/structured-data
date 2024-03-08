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

final class MechanismOfActionModel
{
    public const DESCRIPTION = 'The specific biochemical interaction through which this drug or supplement produces its pharmacological effect.';
    public const LABEL = 'mechanismOfAction';
    public const NAME = 'schema:mechanismOfAction';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'SchemaOrg\Type\DrugModel'];
}
