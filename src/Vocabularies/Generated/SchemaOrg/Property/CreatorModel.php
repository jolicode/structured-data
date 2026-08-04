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

final class CreatorModel
{
    public const DESCRIPTION = 'The creator/author of this CreativeWork. This is the same as the Author property for CreativeWork.';
    public const LABEL = 'creator';
    public const NAME = 'schema:creator';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'UserComments' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\UserCommentsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
