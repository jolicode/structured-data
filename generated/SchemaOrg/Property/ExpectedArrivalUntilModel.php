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

final class ExpectedArrivalUntilModel
{
    public const DESCRIPTION = 'The latest date the package may arrive.';
    public const LABEL = 'expectedArrivalUntil';
    public const NAME = 'schema:expectedArrivalUntil';
    public const VALUES = ['DateModel' => 'SchemaOrg\\Type\\DateModel', 'DateTimeModel' => 'SchemaOrg\\Type\\DateTimeModel'];
    public const TYPES = ['ParcelDelivery' => 'SchemaOrg\\Type\\ParcelDeliveryModel'];
}
