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

final class ExifDataModel
{
    public const DESCRIPTION = 'exif data for this object.';
    public const LABEL = 'exifData';
    public const NAME = 'schema:exifData';
    public const VALUES = ['PropertyValueModel' => 'SchemaOrg\Type\PropertyValueModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['ImageObject' => 'SchemaOrg\Type\ImageObjectModel'];
}
