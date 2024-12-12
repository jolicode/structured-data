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

final class DigitalSourceTypeModel
{
    public const DESCRIPTION = 'Indicates an IPTCDigitalSourceEnumeration code indicating the nature of the digital source(s) for some [[CreativeWork]].';
    public const LABEL = 'digitalSourceType';
    public const NAME = 'schema:digitalSourceType';
    public const VALUES = ['IPTCDigitalSourceEnumerationModel' => 'Jolicode\SchemaOrg\Type\IPTCDigitalSourceEnumerationModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
}
