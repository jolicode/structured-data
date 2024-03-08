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

final class ProprietaryNameModel
{
    public const DESCRIPTION = 'Proprietary name given to the diet plan, typically by its originator or creator.';
    public const LABEL = 'proprietaryName';
    public const NAME = 'schema:proprietaryName';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'SchemaOrg\Type\DietarySupplementModel', 'Drug' => 'SchemaOrg\Type\DrugModel'];
}
