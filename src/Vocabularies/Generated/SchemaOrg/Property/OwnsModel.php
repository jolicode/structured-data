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

final class OwnsModel
{
    public const DESCRIPTION = 'Things owned by the organization or person.';
    public const LABEL = 'owns';
    public const NAME = 'schema:owns';
    public const VALUES = ['ThingModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Organization' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'Person' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/4603'];
    public const SUPERSEDED_BY = null;
}
