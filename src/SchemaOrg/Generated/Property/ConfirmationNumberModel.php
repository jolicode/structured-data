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

final class ConfirmationNumberModel
{
    public const DESCRIPTION = 'A number that confirms the given order or payment has been received.';
    public const LABEL = 'confirmationNumber';
    public const NAME = 'schema:confirmationNumber';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Invoice' => 'Jolicode\SchemaOrg\Type\InvoiceModel', 'Order' => 'Jolicode\SchemaOrg\Type\OrderModel'];
}
