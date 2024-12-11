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

final class DurationOfWarrantyModel
{
    public const DESCRIPTION = 'The duration of the warranty promise. Common unitCode values are ANN for year, MON for months, or DAY for days.';
    public const LABEL = 'durationOfWarranty';
    public const NAME = 'schema:durationOfWarranty';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['WarrantyPromise' => 'Jolicode\SchemaOrg\Type\WarrantyPromiseModel'];
}
