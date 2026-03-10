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

final class ArchiveHeldModel
{
    public const DESCRIPTION = 'Collection, [fonds](https://en.wikipedia.org/wiki/Fonds), or item held, kept or maintained by an [[ArchiveOrganization]].';
    public const LABEL = 'archiveHeld';
    public const NAME = 'schema:archiveHeld';
    public const VALUES = ['ArchiveComponentModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ArchiveComponentModel'];
    public const TYPES = ['ArchiveOrganization' => 'Jolicode\Vocabularies\SchemaOrg\Type\ArchiveOrganizationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
