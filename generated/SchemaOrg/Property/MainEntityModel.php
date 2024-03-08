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

final class MainEntityModel
{
    public const DESCRIPTION = 'Indicates the primary entity described in some page or other CreativeWork.';
    public const LABEL = 'mainEntity';
    public const NAME = 'schema:mainEntity';
    public const VALUES = ['ThingModel' => 'SchemaOrg\Type\ThingModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
