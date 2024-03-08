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

final class UploadDateModel
{
    public const DESCRIPTION = 'Date when this media object was uploaded to this site.';
    public const LABEL = 'uploadDate';
    public const NAME = 'schema:uploadDate';
    public const VALUES = ['DateModel' => 'SchemaOrg\Type\DateModel'];
    public const TYPES = ['MediaObject' => 'SchemaOrg\Type\MediaObjectModel'];
}
