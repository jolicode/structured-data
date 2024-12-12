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

final class AdditionalPropertyModel
{
    public const DESCRIPTION = 'A property-value pair representing an additional characteristic of the entity, e.g. a product feature or another characteristic for which there is no matching property in schema.org.\n\nNote: Publishers should be aware that applications designed to use specific schema.org properties (e.g. https://schema.org/width, https://schema.org/color, https://schema.org/gtin13, ...) will typically expect such data to be provided using those properties, rather than using the generic property/value mechanism.
';
    public const LABEL = 'additionalProperty';
    public const NAME = 'schema:additionalProperty';
    public const VALUES = ['PropertyValueModel' => 'Jolicode\SchemaOrg\Type\PropertyValueModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'Jolicode\SchemaOrg\Type\MerchantReturnPolicyModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel', 'Place' => 'Jolicode\SchemaOrg\Type\PlaceModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel', 'QualitativeValue' => 'Jolicode\SchemaOrg\Type\QualitativeValueModel', 'QuantitativeValue' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
}
