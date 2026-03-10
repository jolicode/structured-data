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

final class MeetsEmissionStandardModel
{
    public const DESCRIPTION = 'Indicates that the vehicle meets the respective emission standard.';
    public const LABEL = 'meetsEmissionStandard';
    public const NAME = 'schema:meetsEmissionStandard';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Vehicle' => 'Jolicode\Vocabularies\SchemaOrg\Type\VehicleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
