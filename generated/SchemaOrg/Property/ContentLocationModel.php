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

final class ContentLocationModel
{
    public const DESCRIPTION = 'The location depicted or described in the content. For example, the location in a photograph or painting.';
    public const LABEL = 'contentLocation';
    public const NAME = 'schema:contentLocation';
    public const VALUES = ['PlaceModel' => 'SchemaOrg\Type\PlaceModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
