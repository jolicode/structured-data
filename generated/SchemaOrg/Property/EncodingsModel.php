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

final class EncodingsModel
{
    public const DESCRIPTION = 'A media object that encodes this CreativeWork.';
    public const LABEL = 'encodings';
    public const NAME = 'schema:encodings';
    public const VALUES = ['MediaObjectModel' => 'SchemaOrg\\Type\\MediaObjectModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
