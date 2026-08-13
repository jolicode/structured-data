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

final class PrescribingInfoModel
{
    public const DESCRIPTION = 'Link to prescribing information for the drug.';
    public const LABEL = 'prescribingInfo';
    public const NAME = 'schema:prescribingInfo';
    public const VALUES = ['URLModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\URLModel'];
    public const TYPES = ['Drug' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DrugModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
