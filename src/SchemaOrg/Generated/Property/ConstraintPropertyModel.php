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

final class ConstraintPropertyModel
{
    public const DESCRIPTION = 'Indicates a property used as a constraint. For example, in the definition of a [[StatisticalVariable]]. The value is a property, either from within Schema.org or from other compatible (e.g. RDF) systems such as DataCommons.org or Wikidata.org.';
    public const LABEL = 'constraintProperty';
    public const NAME = 'schema:constraintProperty';
    public const VALUES = ['PropertyModel' => 'Jolicode\SchemaOrg\Type\PropertyModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['ConstraintNode' => 'Jolicode\SchemaOrg\Type\ConstraintNodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
