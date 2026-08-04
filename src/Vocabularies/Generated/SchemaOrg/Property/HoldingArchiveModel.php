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

final class HoldingArchiveModel
{
    public const DESCRIPTION = '[[ArchiveOrganization]] that holds, keeps or maintains the [[ArchiveComponent]].';
    public const LABEL = 'holdingArchive';
    public const NAME = 'schema:holdingArchive';
    public const VALUES = ['ArchiveOrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ArchiveOrganizationModel'];
    public const TYPES = ['ArchiveComponent' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ArchiveComponentModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1758'];
    public const SUPERSEDED_BY = null;
}
