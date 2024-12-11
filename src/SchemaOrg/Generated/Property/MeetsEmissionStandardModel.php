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

final class MeetsEmissionStandardModel
{
    public const DESCRIPTION = 'Indicates that the vehicle meets the respective emission standard.';
    public const LABEL = 'meetsEmissionStandard';
    public const NAME = 'schema:meetsEmissionStandard';
    public const VALUES = ['QualitativeValueModel' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Vehicle' => 'Jolicode\SchemaOrg\Type\VehicleModel'];
}
