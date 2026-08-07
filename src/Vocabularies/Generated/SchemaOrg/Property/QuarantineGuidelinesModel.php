<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class QuarantineGuidelinesModel
{
    public const DESCRIPTION = 'Guidelines about quarantine rules, e.g. in the context of a pandemic.';
    public const LABEL = 'quarantineGuidelines';
    public const NAME = 'schema:quarantineGuidelines';
    public const VALUES = ['URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel', 'WebContentModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\WebContentModel'];
    public const TYPES = ['SpecialAnnouncement' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SpecialAnnouncementModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2490'];
    public const SUPERSEDED_BY = null;
}
