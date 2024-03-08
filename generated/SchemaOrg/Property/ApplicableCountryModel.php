<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ApplicableCountryModel
{
    public const DESCRIPTION = 'A country where a particular merchant return policy applies to, for example the two-letter ISO 3166-1 alpha-2 country code.';
    public const LABEL = 'applicableCountry';
    public const NAME = 'schema:applicableCountry';
    public const VALUES = ['CountryModel' => 'SchemaOrg\Type\CountryModel', 'TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MerchantReturnPolicy' => 'SchemaOrg\Type\MerchantReturnPolicyModel'];
}
