<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class EngineTypeModel
{
    public const DESCRIPTION = 'The type of engine or engines powering the vehicle.';
    public const LABEL = 'engineType';
    public const NAME = 'schema:engineType';
    public const VALUES = ['QualitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['EngineSpecification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\EngineSpecificationModel'];
    public const IS_PART_OF = ['https://auto.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
