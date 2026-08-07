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

final class CustomerRemorseReturnFeesModel
{
    public const DESCRIPTION = 'The type of return fees if the product is returned due to customer remorse.';
    public const LABEL = 'customerRemorseReturnFees';
    public const NAME = 'schema:customerRemorseReturnFees';
    public const VALUES = ['ReturnFeesEnumerationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ReturnFeesEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MerchantReturnPolicyModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/2880'];
    public const SUPERSEDED_BY = null;
}
