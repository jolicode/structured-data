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

final class TravelBansModel
{
    public const DESCRIPTION = 'Information about travel bans, e.g. in the context of a pandemic.';
    public const LABEL = 'travelBans';
    public const NAME = 'schema:travelBans';
    public const VALUES = ['URLModel' => 'Jolicode\SchemaOrg\Type\URLModel', 'WebContentModel' => 'Jolicode\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'Jolicode\SchemaOrg\Type\SpecialAnnouncementModel'];
}
