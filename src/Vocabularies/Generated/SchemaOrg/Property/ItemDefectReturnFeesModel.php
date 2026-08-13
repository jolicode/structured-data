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

final class ItemDefectReturnFeesModel
{
    public const DESCRIPTION = 'The type of return fees for returns of defect products.';
    public const LABEL = 'itemDefectReturnFees';
    public const NAME = 'schema:itemDefectReturnFees';
    public const VALUES = ['ReturnFeesEnumerationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ReturnFeesEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicyModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2880'];
    public const SUPERSEDED_BY = null;
}
