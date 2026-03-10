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

final class RequiresSubscriptionModel
{
    public const DESCRIPTION = 'Indicates if use of the media require a subscription  (either paid or free). Allowed values are ```true``` or ```false``` (note that an earlier version had \'yes\', \'no\').';
    public const LABEL = 'requiresSubscription';
    public const NAME = 'schema:requiresSubscription';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BooleanModel', 'MediaSubscriptionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaSubscriptionModel'];
    public const TYPES = ['ActionAccessSpecification' => 'Jolicode\Vocabularies\SchemaOrg\Type\ActionAccessSpecificationModel', 'MediaObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
