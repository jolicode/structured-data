<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class RecordedAtModel
{
    public const DESCRIPTION = 'The Event where the CreativeWork was recorded. The CreativeWork may capture all or part of the event.';
    public const LABEL = 'recordedAt';
    public const NAME = 'schema:recordedAt';
    public const VALUES = ['EventModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
