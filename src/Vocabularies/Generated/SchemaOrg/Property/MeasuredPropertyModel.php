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

final class MeasuredPropertyModel
{
    public const DESCRIPTION = 'The measuredProperty of an [[Observation]], typically via its [[StatisticalVariable]]. There are various kinds of applicable [[Property]]: a schema.org property, a property from other RDF-compatible systems, e.g. W3C RDF Data Cube, Data Commons, Wikidata, or schema.org extensions such as [GS1\'s](https://www.gs1.org/voc/?show=properties).';
    public const LABEL = 'measuredProperty';
    public const NAME = 'schema:measuredProperty';
    public const VALUES = ['PropertyModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\PropertyModel'];
    public const TYPES = ['Observation' => 'Jolicode\Vocabularies\SchemaOrg\Type\ObservationModel', 'StatisticalVariable' => 'Jolicode\Vocabularies\SchemaOrg\Type\StatisticalVariableModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
