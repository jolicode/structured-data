<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class EngineTypeModel
{
    public const DESCRIPTION = 'The type of engine or engines powering the vehicle.';
    public const LABEL = 'engineType';
    public const NAME = 'schema:engineType';
    public const VALUES = ['QualitativeValueModel' => 'SchemaOrg\\Type\\QualitativeValueModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['EngineSpecification' => 'SchemaOrg\\Type\\EngineSpecificationModel'];
}
