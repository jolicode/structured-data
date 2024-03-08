<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ItemDefectReturnLabelSourceModel
{
    public const DESCRIPTION = 'The method (from an enumeration) by which the customer obtains a return shipping label for a defect product.';
    public const LABEL = 'itemDefectReturnLabelSource';
    public const NAME = 'schema:itemDefectReturnLabelSource';
    public const VALUES = ['ReturnLabelSourceEnumerationModel' => 'SchemaOrg\Type\ReturnLabelSourceEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'SchemaOrg\Type\MerchantReturnPolicyModel'];
}
