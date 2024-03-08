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

final class OrderNumberModel
{
    public const DESCRIPTION = 'The identifier of the transaction.';
    public const LABEL = 'orderNumber';
    public const NAME = 'schema:orderNumber';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Order' => 'SchemaOrg\\Type\\OrderModel'];
}
