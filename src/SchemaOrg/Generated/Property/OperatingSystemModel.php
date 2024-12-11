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

final class OperatingSystemModel
{
    public const DESCRIPTION = 'Operating systems supported (Windows 7, OS X 10.6, Android 1.6).';
    public const LABEL = 'operatingSystem';
    public const NAME = 'schema:operatingSystem';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareApplication' => 'Jolicode\SchemaOrg\Type\SoftwareApplicationModel'];
}
