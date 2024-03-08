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

final class ItemShippedModel
{
    public const DESCRIPTION = 'Item(s) being shipped.';
    public const LABEL = 'itemShipped';
    public const NAME = 'schema:itemShipped';
    public const VALUES = ['ProductModel' => 'SchemaOrg\\Type\\ProductModel'];
    public const TYPES = ['ParcelDelivery' => 'SchemaOrg\\Type\\ParcelDeliveryModel'];
}
