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

final class NumConstraintsModel
{
    public const DESCRIPTION = 'Indicates the number of constraints property values defined for a particular [[ConstraintNode]] such as [[StatisticalVariable]]. This helps applications understand if they have access to a sufficiently complete description of a [[StatisticalVariable]] or other construct that is defined using properties on template-style nodes.';
    public const LABEL = 'numConstraints';
    public const NAME = 'schema:numConstraints';
    public const VALUES = ['IntegerModel' => 'Jolicode\SchemaOrg\Type\IntegerModel'];
    public const TYPES = ['ConstraintNode' => 'Jolicode\SchemaOrg\Type\ConstraintNodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
