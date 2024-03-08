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

final class SdDatePublishedModel
{
    public const DESCRIPTION = 'Indicates the date on which the current structured data was generated / published. Typically used alongside [[sdPublisher]]';
    public const LABEL = 'sdDatePublished';
    public const NAME = 'schema:sdDatePublished';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
