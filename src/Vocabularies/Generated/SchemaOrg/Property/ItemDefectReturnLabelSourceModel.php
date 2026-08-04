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

final class ItemDefectReturnLabelSourceModel
{
    public const DESCRIPTION = 'The method (from an enumeration) by which the customer obtains a return shipping label for a defect product.';
    public const LABEL = 'itemDefectReturnLabelSource';
    public const NAME = 'schema:itemDefectReturnLabelSource';
    public const VALUES = ['ReturnLabelSourceEnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ReturnLabelSourceEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicyModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2880'];
    public const SUPERSEDED_BY = null;
}
