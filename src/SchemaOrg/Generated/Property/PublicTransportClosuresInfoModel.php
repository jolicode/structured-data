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

final class PublicTransportClosuresInfoModel
{
    public const DESCRIPTION = 'Information about public transport closures.';
    public const LABEL = 'publicTransportClosuresInfo';
    public const NAME = 'schema:publicTransportClosuresInfo';
    public const VALUES = ['URLModel' => 'Jolicode\SchemaOrg\Type\URLModel', 'WebContentModel' => 'Jolicode\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'Jolicode\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
