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

final class RsvpResponseModel
{
    public const DESCRIPTION = 'The response (yes, no, maybe) to the RSVP.';
    public const LABEL = 'rsvpResponse';
    public const NAME = 'schema:rsvpResponse';
    public const VALUES = ['RsvpResponseTypeModel' => 'Jolicode\SchemaOrg\Type\RsvpResponseTypeModel'];
    public const TYPES = ['RsvpAction' => 'Jolicode\SchemaOrg\Type\RsvpActionModel'];
}
