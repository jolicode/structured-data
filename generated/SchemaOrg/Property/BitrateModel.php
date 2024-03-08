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

final class BitrateModel
{
    public const DESCRIPTION = 'The bitrate of the media object.';
    public const LABEL = 'bitrate';
    public const NAME = 'schema:bitrate';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['MediaObject' => 'SchemaOrg\\Type\\MediaObjectModel'];
}
