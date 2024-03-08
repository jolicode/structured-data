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

final class ContentSizeModel
{
    public const DESCRIPTION = 'File size in (mega/kilo)bytes.';
    public const LABEL = 'contentSize';
    public const NAME = 'schema:contentSize';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['MediaObject' => 'SchemaOrg\\Type\\MediaObjectModel'];
}
