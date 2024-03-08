<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class CreatorModel
{
    public const DESCRIPTION = 'The creator/author of this CreativeWork. This is the same as the Author property for CreativeWork.';
    public const LABEL = 'creator';
    public const NAME = 'schema:creator';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'UserComments' => 'SchemaOrg\Type\UserCommentsModel'];
}
