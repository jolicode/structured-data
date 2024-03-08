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

final class PerformerInModel
{
    public const DESCRIPTION = 'Event that this person is a performer or participant in.';
    public const LABEL = 'performerIn';
    public const NAME = 'schema:performerIn';
    public const VALUES = ['EventModel' => 'SchemaOrg\\Type\\EventModel'];
    public const TYPES = ['Person' => 'SchemaOrg\\Type\\PersonModel'];
}
