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

final class RecordedAtModel
{
    public const DESCRIPTION = 'The Event where the CreativeWork was recorded. The CreativeWork may capture all or part of the event.';
    public const LABEL = 'recordedAt';
    public const NAME = 'schema:recordedAt';
    public const VALUES = ['EventModel' => 'SchemaOrg\\Type\\EventModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\\Type\\CreativeWorkModel'];
}
