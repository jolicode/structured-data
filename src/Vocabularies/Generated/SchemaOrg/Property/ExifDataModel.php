<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class ExifDataModel
{
    public const DESCRIPTION = 'exif data for this object.';
    public const LABEL = 'exifData';
    public const NAME = 'schema:exifData';
    public const VALUES = ['PropertyValueModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyValueModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ImageObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\ImageObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
