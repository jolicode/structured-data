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

final class AvailableOnDeviceModel
{
    public const DESCRIPTION = 'Device required to run the application. Used in cases where a specific make/model is required to run the application.';
    public const LABEL = 'availableOnDevice';
    public const NAME = 'schema:availableOnDevice';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\Type\SoftwareApplicationModel'];
}
