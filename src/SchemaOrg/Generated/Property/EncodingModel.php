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

final class EncodingModel
{
    public const DESCRIPTION = 'A media object that encodes this CreativeWork. This property is a synonym for associatedMedia.';
    public const LABEL = 'encoding';
    public const NAME = 'schema:encoding';
    public const VALUES = ['MediaObjectModel' => 'Jolicode\SchemaOrg\Type\MediaObjectModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel'];
}
