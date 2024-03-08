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

final class MeetsEmissionStandardModel
{
    public const DESCRIPTION = 'Indicates that the vehicle meets the respective emission standard.';
    public const LABEL = 'meetsEmissionStandard';
    public const NAME = 'schema:meetsEmissionStandard';
    public const VALUES = ['QualitativeValueModel' => 'SchemaOrg\Type\QualitativeValueModel', 'TextModel' => 'SchemaOrg\Type\TextModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['Vehicle' => 'SchemaOrg\Type\VehicleModel'];
}
