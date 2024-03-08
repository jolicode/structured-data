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

final class IsPartOfModel
{
    public const DESCRIPTION = 'Indicates an item or CreativeWork that this item, or CreativeWork (in some sense), is part of.';
    public const LABEL = 'isPartOf';
    public const NAME = 'schema:isPartOf';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
