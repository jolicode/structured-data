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

final class PublicationModel
{
    public const DESCRIPTION = 'A publication event associated with the item.';
    public const LABEL = 'publication';
    public const NAME = 'schema:publication';
    public const VALUES = ['PublicationEventModel' => 'SchemaOrg\\Type\\PublicationEventModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
