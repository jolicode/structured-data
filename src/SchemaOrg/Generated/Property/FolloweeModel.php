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

final class FolloweeModel
{
    public const DESCRIPTION = 'A sub property of object. The person or organization being followed.';
    public const LABEL = 'followee';
    public const NAME = 'schema:followee';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['FollowAction' => 'Jolicode\SchemaOrg\Type\FollowActionModel'];
}
