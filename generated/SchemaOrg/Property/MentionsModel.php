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

final class MentionsModel
{
    public const DESCRIPTION = 'Indicates that the CreativeWork contains a reference to, but is not necessarily about a concept.';
    public const LABEL = 'mentions';
    public const NAME = 'schema:mentions';
    public const VALUES = ['ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
