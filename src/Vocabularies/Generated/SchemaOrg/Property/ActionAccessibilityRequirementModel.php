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

final class ActionAccessibilityRequirementModel
{
    public const DESCRIPTION = 'A set of requirements that must be fulfilled in order to perform an Action. If more than one value is specified, fulfilling one set of requirements will allow the Action to be performed.';
    public const LABEL = 'actionAccessibilityRequirement';
    public const NAME = 'schema:actionAccessibilityRequirement';
    public const VALUES = ['ActionAccessSpecificationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ActionAccessSpecificationModel'];
    public const TYPES = ['ConsumeAction' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ConsumeActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1741'];
    public const SUPERSEDED_BY = null;
}
