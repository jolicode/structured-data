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

final class NonProprietaryNameModel
{
    public const DESCRIPTION = 'The generic name of this drug or supplement.';
    public const LABEL = 'nonProprietaryName';
    public const NAME = 'schema:nonProprietaryName';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'SchemaOrg\Type\DrugModel'];
}
