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

final class RsvpResponseModel
{
    public const DESCRIPTION = 'The response (yes, no, maybe) to the RSVP.';
    public const LABEL = 'rsvpResponse';
    public const NAME = 'schema:rsvpResponse';
    public const VALUES = ['RsvpResponseTypeModel' => 'SchemaOrg\\Type\\RsvpResponseTypeModel'];
    public const TYPES = ['RsvpAction' => 'SchemaOrg\\Type\\RsvpActionModel'];
}
