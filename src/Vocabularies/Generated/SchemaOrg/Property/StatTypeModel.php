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

final class StatTypeModel
{
    public const DESCRIPTION = 'Indicates the kind of statistic represented by a [[StatisticalVariable]], e.g. mean, count etc. The value of statType is a property, either from within Schema.org (e.g. [[median]], [[marginOfError]], [[maxValue]], [[minValue]]) or from other compatible (e.g. RDF) systems such as DataCommons.org or Wikidata.org.';
    public const LABEL = 'statType';
    public const NAME = 'schema:statType';
    public const VALUES = ['PropertyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel', 'URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['StatisticalVariable' => 'Jolicode\Vocabularies\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
