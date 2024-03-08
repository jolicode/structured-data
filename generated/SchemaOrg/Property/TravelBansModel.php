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

final class TravelBansModel
{
    public const DESCRIPTION = 'Information about travel bans, e.g. in the context of a pandemic.';
    public const LABEL = 'travelBans';
    public const NAME = 'schema:travelBans';
    public const VALUES = ['URLModel' => 'SchemaOrg\\Type\\URLModel', 'WebContentModel' => 'SchemaOrg\\Type\\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'SchemaOrg\\Type\\SpecialAnnouncementModel'];
}
