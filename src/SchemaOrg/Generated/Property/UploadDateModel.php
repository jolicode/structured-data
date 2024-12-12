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

final class UploadDateModel
{
    public const DESCRIPTION = 'Date (including time if available) when this media object was uploaded to this site.';
    public const LABEL = 'uploadDate';
    public const NAME = 'schema:uploadDate';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['MediaObject' => 'Jolicode\SchemaOrg\Type\MediaObjectModel'];
}
