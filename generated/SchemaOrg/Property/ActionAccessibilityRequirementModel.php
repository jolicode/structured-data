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

final class ActionAccessibilityRequirementModel
{
    public const DESCRIPTION = 'A set of requirements that must be fulfilled in order to perform an Action. If more than one value is specified, fulfilling one set of requirements will allow the Action to be performed.';
    public const LABEL = 'actionAccessibilityRequirement';
    public const NAME = 'schema:actionAccessibilityRequirement';
    public const VALUES = ['ActionAccessSpecificationModel' => 'SchemaOrg\Type\ActionAccessSpecificationModel'];
    public const TYPES = ['ConsumeAction' => 'SchemaOrg\Type\ConsumeActionModel'];
}
