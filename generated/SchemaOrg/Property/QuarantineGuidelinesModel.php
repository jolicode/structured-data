<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class QuarantineGuidelinesModel
{
    public const DESCRIPTION = 'Guidelines about quarantine rules, e.g. in the context of a pandemic.';
    public const LABEL = 'quarantineGuidelines';
    public const NAME = 'schema:quarantineGuidelines';
    public const VALUES = ['URLModel' => 'SchemaOrg\Type\URLModel', 'WebContentModel' => 'SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'SchemaOrg\Type\SpecialAnnouncementModel'];
}
