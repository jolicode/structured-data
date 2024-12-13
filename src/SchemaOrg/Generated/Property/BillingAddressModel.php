<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class BillingAddressModel
{
    public const DESCRIPTION = 'The billing address for the order.';
    public const LABEL = 'billingAddress';
    public const NAME = 'schema:billingAddress';
    public const VALUES = ['PostalAddressModel' => 'Jolicode\SchemaOrg\Type\PostalAddressModel'];
    public const TYPES = ['Order' => 'Jolicode\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
