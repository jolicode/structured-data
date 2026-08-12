<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class SoftwareRequirementsModel
{
    public const DESCRIPTION = 'Component dependency requirements for application. This includes runtime environments and shared libraries that are not included in the application distribution package, but required to run the application (examples: DirectX, Java or .NET runtime).';
    public const LABEL = 'softwareRequirements';
    public const NAME = 'schema:softwareRequirements';
    public const VALUES = ['SoftwareApplicationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SoftwareApplicationModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['SoftwareApplication' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\SoftwareApplicationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
