<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class RefundTypeModel
{
    public const DESCRIPTION = 'A refund type, from an enumerated list.';
    public const LABEL = 'refundType';
    public const NAME = 'schema:refundType';
    public const VALUES = ['RefundTypeEnumerationModel' => 'SchemaOrg\\Type\\RefundTypeEnumerationModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'SchemaOrg\\Type\\MerchantReturnPolicyModel'];
}
