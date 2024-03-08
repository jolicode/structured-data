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

final class AttendeesModel
{
    public const DESCRIPTION = 'A person attending the event.';
    public const LABEL = 'attendees';
    public const NAME = 'schema:attendees';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['Event' => 'SchemaOrg\\Type\\EventModel'];
}
