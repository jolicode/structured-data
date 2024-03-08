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

final class HasMeasurementModel
{
    public const DESCRIPTION = 'A product measurement, for example the inseam of pants, the wheel size of a bicycle, or the gauge of a screw. Usually an exact measurement, but can also be a range of measurements for adjustable products, for example belts and ski bindings.';
    public const LABEL = 'hasMeasurement';
    public const NAME = 'schema:hasMeasurement';
    public const VALUES = ['QuantitativeValueModel' => 'SchemaOrg\\Type\\QuantitativeValueModel'];
    public const TYPES = ['Offer' => 'SchemaOrg\\Type\\OfferModel', 'Product' => 'SchemaOrg\\Type\\ProductModel', 'SizeSpecification' => 'SchemaOrg\\Type\\SizeSpecificationModel'];
}
