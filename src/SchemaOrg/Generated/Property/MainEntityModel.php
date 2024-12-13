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

final class MainEntityModel
{
    public const DESCRIPTION = 'Indicates the primary entity described in some page or other CreativeWork.';
    public const LABEL = 'mainEntity';
    public const NAME = 'schema:mainEntity';
    public const VALUES = ['ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
