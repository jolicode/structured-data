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

final class CreatorModel
{
    public const DESCRIPTION = 'The creator/author of this CreativeWork. This is the same as the Author property for CreativeWork.';
    public const LABEL = 'creator';
    public const NAME = 'schema:creator';
    public const VALUES = ['OrganizationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'UserComments' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\UserCommentsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
