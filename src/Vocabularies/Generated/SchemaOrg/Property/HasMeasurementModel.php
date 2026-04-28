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

final class HasMeasurementModel
{
    public const DESCRIPTION = 'A measurement of an item, For example, the inseam of pants, the wheel size of a bicycle, the gauge of a screw, or the carbon footprint measured for certification by an authority. Usually an exact measurement, but can also be a range of measurements for adjustable products, for example belts and ski bindings.';
    public const LABEL = 'hasMeasurement';
    public const NAME = 'schema:hasMeasurement';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['Certification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CertificationModel', 'Offer' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\OfferModel', 'Product' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\ProductModel', 'SizeSpecification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\SizeSpecificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
