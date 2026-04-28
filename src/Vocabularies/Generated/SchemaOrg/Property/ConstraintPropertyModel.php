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

final class ConstraintPropertyModel
{
    public const DESCRIPTION = 'Indicates a property used as a constraint. For example, in the definition of a [[StatisticalVariable]]. The value is a property, either from within Schema.org or from other compatible (e.g. RDF) systems such as DataCommons.org or Wikidata.org.';
    public const LABEL = 'constraintProperty';
    public const NAME = 'schema:constraintProperty';
    public const VALUES = ['PropertyModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PropertyModel', 'URLModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['ConstraintNode' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ConstraintNodeModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
