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

final class NewsUpdatesAndGuidelinesModel
{
    public const DESCRIPTION = 'Indicates a page with news updates and guidelines. This could often be (but is not required to be) the main page containing [[SpecialAnnouncement]] markup on a site.';
    public const LABEL = 'newsUpdatesAndGuidelines';
    public const NAME = 'schema:newsUpdatesAndGuidelines';
    public const VALUES = ['URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel', 'WebContentModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'Jolicode\Vocabularies\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
