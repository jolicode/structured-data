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

final class PartOfInvoiceModel
{
    public const DESCRIPTION = 'The order is being paid as part of the referenced Invoice.';
    public const LABEL = 'partOfInvoice';
    public const NAME = 'schema:partOfInvoice';
    public const VALUES = ['InvoiceModel' => 'Jolicode\SchemaOrg\Type\InvoiceModel'];
    public const TYPES = ['Order' => 'Jolicode\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
