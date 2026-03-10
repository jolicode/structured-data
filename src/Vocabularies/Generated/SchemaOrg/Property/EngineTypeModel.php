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

final class EngineTypeModel
{
    public const DESCRIPTION = 'The type of engine or engines powering the vehicle.';
    public const LABEL = 'engineType';
    public const NAME = 'schema:engineType';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['EngineSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\EngineSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
