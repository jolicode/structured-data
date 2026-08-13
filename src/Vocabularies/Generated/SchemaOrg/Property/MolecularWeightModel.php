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

final class MolecularWeightModel
{
    public const DESCRIPTION = 'This is the molecular weight of the entity being described, not of the parent. Units should be included in the form \'&lt;Number&gt; &lt;unit&gt;\', for example \'12 amu\' or as \'&lt;QuantitativeValue&gt;.';
    public const LABEL = 'molecularWeight';
    public const NAME = 'schema:molecularWeight';
    public const VALUES = ['QuantitativeValueModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MolecularEntity' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MolecularEntityModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['http://www.bioschemas.org/MolecularEntity'];
    public const SUPERSEDED_BY = null;
}
