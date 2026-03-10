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

final class ReturnMethodModel
{
    public const DESCRIPTION = 'The type of return method offered, specified from an enumeration.';
    public const LABEL = 'returnMethod';
    public const NAME = 'schema:returnMethod';
    public const VALUES = ['ReturnMethodEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReturnMethodEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicyModel', 'MerchantReturnPolicySeasonalOverride' => 'Jolicode\Vocabularies\SchemaOrg\Type\MerchantReturnPolicySeasonalOverrideModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
