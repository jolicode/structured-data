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

final class HoldingArchiveModel
{
    public const DESCRIPTION = '[[ArchiveOrganization]] that holds, keeps or maintains the [[ArchiveComponent]].';
    public const LABEL = 'holdingArchive';
    public const NAME = 'schema:holdingArchive';
    public const VALUES = ['ArchiveOrganizationModel' => 'SchemaOrg\\Type\\ArchiveOrganizationModel'];
    public const TYPES = ['ArchiveComponent' => 'SchemaOrg\\Type\\ArchiveComponentModel'];
}
