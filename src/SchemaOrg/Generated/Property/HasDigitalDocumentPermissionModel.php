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

final class HasDigitalDocumentPermissionModel
{
    public const DESCRIPTION = 'A permission related to the access to this document (e.g. permission to read or write an electronic document). For a public document, specify a grantee with an Audience with audienceType equal to "public".';
    public const LABEL = 'hasDigitalDocumentPermission';
    public const NAME = 'schema:hasDigitalDocumentPermission';
    public const VALUES = ['DigitalDocumentPermissionModel' => 'Jolicode\SchemaOrg\Type\DigitalDocumentPermissionModel'];
    public const TYPES = ['DigitalDocument' => 'Jolicode\SchemaOrg\Type\DigitalDocumentModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
