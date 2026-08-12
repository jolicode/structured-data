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

final class ConstraintPropertyModel
{
    public const DESCRIPTION = 'Indicates a property used as a constraint. For example, in the definition of a [[StatisticalVariable]]. The value is a property, either from within Schema.org or from other compatible (e.g. RDF) systems such as DataCommons.org or Wikidata.org.';
    public const LABEL = 'constraintProperty';
    public const NAME = 'schema:constraintProperty';
    public const VALUES = ['PropertyModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PropertyModel', 'URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['ConstraintNode' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ConstraintNodeModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2291'];
    public const SUPERSEDED_BY = null;
}
