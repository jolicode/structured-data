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

final class CreatorModel
{
    public const DESCRIPTION = 'The creator/author of this CreativeWork. This is the same as the Author property for CreativeWork.';
    public const LABEL = 'creator';
    public const NAME = 'schema:creator';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'UserComments' => 'Jolicode\Vocabularies\SchemaOrg\Type\UserCommentsModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
