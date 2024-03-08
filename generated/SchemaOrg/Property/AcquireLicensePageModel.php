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

final class AcquireLicensePageModel
{
    public const DESCRIPTION = 'Indicates a page documenting how licenses can be purchased or otherwise acquired, for the current item.';
    public const LABEL = 'acquireLicensePage';
    public const NAME = 'schema:acquireLicensePage';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel', 'URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
