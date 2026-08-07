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

final class DeviceModel
{
    public const DESCRIPTION = 'Device required to run the application. Used in cases where a specific make/model is required to run the application.';
    public const LABEL = 'device';
    public const NAME = 'schema:device';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareApplication' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SoftwareApplicationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'availableOnDevice';
}
