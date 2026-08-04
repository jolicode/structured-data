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

final class BodyTypeModel
{
    public const DESCRIPTION = 'Indicates the design and body style of the vehicle (e.g. station wagon, hatchback, etc.).';
    public const LABEL = 'bodyType';
    public const NAME = 'schema:bodyType';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Vehicle' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = ['https://auto.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
