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

final class SoftwareVersionModel
{
    public const DESCRIPTION = 'Version of the software instance.';
    public const LABEL = 'softwareVersion';
    public const NAME = 'schema:softwareVersion';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\Type\SoftwareApplicationModel'];
}
