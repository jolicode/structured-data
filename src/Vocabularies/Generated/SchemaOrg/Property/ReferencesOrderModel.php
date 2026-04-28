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

final class ReferencesOrderModel
{
    public const DESCRIPTION = 'The Order(s) related to this Invoice. One or more Orders may be combined into a single Invoice.';
    public const LABEL = 'referencesOrder';
    public const NAME = 'schema:referencesOrder';
    public const VALUES = ['OrderModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const TYPES = ['Invoice' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
