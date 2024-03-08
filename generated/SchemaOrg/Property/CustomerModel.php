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

final class CustomerModel
{
    public const DESCRIPTION = 'Party placing the order or paying the invoice.';
    public const LABEL = 'customer';
    public const NAME = 'schema:customer';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'SchemaOrg\Type\PersonModel'];
    public const TYPES = ['Invoice' => 'SchemaOrg\Type\InvoiceModel', 'Order' => 'SchemaOrg\Type\OrderModel'];
}
