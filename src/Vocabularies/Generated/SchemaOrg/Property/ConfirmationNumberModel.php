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

final class ConfirmationNumberModel
{
    public const DESCRIPTION = 'A number that confirms the given order or payment has been received.';
    public const LABEL = 'confirmationNumber';
    public const NAME = 'schema:confirmationNumber';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Invoice' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\InvoiceModel', 'Order' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OrderModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
