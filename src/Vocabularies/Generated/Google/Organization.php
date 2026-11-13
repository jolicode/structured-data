<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\Google;

final class Organization
{
    public const SUPPORTED_TYPES = ['Organization', 'OnlineStore'];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/organization';
    public const SPECIAL_RULE_KEYS = ['google.organization.return_policy', 'google.organization.tax_id_country_consistency', 'google.organization.member_tier_loyalty_points'];
    public const STANDALONE = true;
    public const ACCEPTS_SUBTYPES = true;
    public const EXCLUDED_SUBTYPES = [];
    public const PROPERTIES = [
        'address' => [
            'name' => 'address',
            'severity' => 'optional',
            'supportedTypes' => [
                'PostalAddress',
            ],
            'properties' => [
                'addressCountry' => [
                    'name' => 'addressCountry',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'addressLocality' => [
                    'name' => 'addressLocality',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'addressRegion' => [
                    'name' => 'addressRegion',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'postalCode' => [
                    'name' => 'postalCode',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'streetAddress' => [
                    'name' => 'streetAddress',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
        'alternateName' => [
            'name' => 'alternateName',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'contactPoint' => [
            'name' => 'contactPoint',
            'severity' => 'optional',
            'supportedTypes' => [
                'ContactPoint',
            ],
            'properties' => [
                'email' => [
                    'name' => 'email',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'telephone' => [
                    'name' => 'telephone',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
        'description' => [
            'name' => 'description',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'duns' => [
            'name' => 'duns',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'email' => [
            'name' => 'email',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'foundingDate' => [
            'name' => 'foundingDate',
            'severity' => 'optional',
            'supportedTypes' => [
                'Date',
            ],
        ],
        'globalLocationNumber' => [
            'name' => 'globalLocationNumber',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'hasMerchantReturnPolicy' => [
            'name' => 'hasMerchantReturnPolicy',
            'severity' => 'optional',
            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/return-policy',
            'supportedTypes' => [
                'MerchantReturnPolicy',
            ],
            'properties' => [
                'atLeastOneOf' => [
                    'name' => 'atLeastOneOf',
                    'severity' => 'required',
                    'value' => [
                        'merchantReturnLink' => true,
                        'returnPolicyCategory' => true,
                    ],
                ],
                'applicableCountry' => [
                    'name' => 'applicableCountry',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'returnPolicyCategory' => [
                    'name' => 'returnPolicyCategory',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'MerchantReturnEnumeration',
                    ],
                ],
                'merchantReturnLink' => [
                    'name' => 'merchantReturnLink',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
                'merchantReturnDays' => [
                    'name' => 'merchantReturnDays',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
                'returnFees' => [
                    'name' => 'returnFees',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ReturnFeesEnumeration',
                    ],
                ],
                'returnMethod' => [
                    'name' => 'returnMethod',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ReturnMethodEnumeration',
                    ],
                ],
                'returnShippingFeesAmount' => [
                    'name' => 'returnShippingFeesAmount',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'MonetaryAmount',
                    ],
                ],
                'customerRemorseReturnFees' => [
                    'name' => 'customerRemorseReturnFees',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ReturnFeesEnumeration',
                    ],
                ],
                'customerRemorseReturnLabelSource' => [
                    'name' => 'customerRemorseReturnLabelSource',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ReturnLabelSourceEnumeration',
                    ],
                ],
                'customerRemorseReturnShippingFeesAmount' => [
                    'name' => 'customerRemorseReturnShippingFeesAmount',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'MonetaryAmount',
                    ],
                ],
                'itemCondition' => [
                    'name' => 'itemCondition',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'OfferItemCondition',
                    ],
                ],
                'itemDefectReturnFees' => [
                    'name' => 'itemDefectReturnFees',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ReturnFeesEnumeration',
                    ],
                ],
                'itemDefectReturnLabelSource' => [
                    'name' => 'itemDefectReturnLabelSource',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ReturnLabelSourceEnumeration',
                    ],
                ],
                'itemDefectReturnShippingFeesAmount' => [
                    'name' => 'itemDefectReturnShippingFeesAmount',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'MonetaryAmount',
                    ],
                ],
                'refundType' => [
                    'name' => 'refundType',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'RefundType',
                    ],
                ],
                'restockingFee' => [
                    'name' => 'restockingFee',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'MonetaryAmount',
                        'Number',
                    ],
                ],
                'returnLabelSource' => [
                    'name' => 'returnLabelSource',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ReturnLabelSourceEnumeration',
                    ],
                ],
                'returnPolicyCountry' => [
                    'name' => 'returnPolicyCountry',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'returnPolicySeasonalOverride' => [
                    'name' => 'returnPolicySeasonalOverride',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'MerchantReturnPolicySeasonalOverride',
                    ],
                    'properties' => [
                        'returnPolicyCategory' => [
                            'name' => 'returnPolicyCategory',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'MerchantReturnEnumeration',
                            ],
                        ],
                        'startDate' => [
                            'name' => 'startDate',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Date',
                                'DateTime',
                            ],
                        ],
                        'endDate' => [
                            'name' => 'endDate',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'Date',
                                'DateTime',
                            ],
                        ],
                        'merchantReturnDays' => [
                            'name' => 'merchantReturnDays',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'Integer',
                                'Date',
                                'DateTime',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'hasMemberProgram' => [
            'name' => 'hasMemberProgram',
            'severity' => 'optional',
            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/loyalty-program',
            'supportedTypes' => [
                'MemberProgram',
            ],
            'properties' => [
                'name' => [
                    'name' => 'name',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'description' => [
                    'name' => 'description',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'hasTiers' => [
                    'name' => 'hasTiers',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'MemberProgramTier',
                    ],
                    'properties' => [
                        'name' => [
                            'name' => 'name',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'Text',
                            ],
                        ],
                        'hasTierBenefit' => [
                            'name' => 'hasTierBenefit',
                            'severity' => 'required',
                            'supportedTypes' => [
                                'TierBenefitEnumeration',
                            ],
                        ],
                        'hasTierRequirement' => [
                            'name' => 'hasTierRequirement',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'CreditCard',
                                'MonetaryAmount',
                                'UnitPriceSpecification',
                                'Text',
                            ],
                        ],
                        'membershipPointsEarned' => [
                            'name' => 'membershipPointsEarned',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'QuantitativeValue',
                            ],
                        ],
                        'url' => [
                            'name' => 'url',
                            'severity' => 'recommended',
                            'supportedTypes' => [
                                'URL',
                            ],
                        ],
                    ],
                ],
                'url' => [
                    'name' => 'url',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
            ],
        ],
        'hasShippingService' => [
            'name' => 'hasShippingService',
            'severity' => 'optional',
            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/shipping-policy',
            'supportedTypes' => [
                'ShippingService',
            ],
            'properties' => [
                'shippingConditions' => [
                    'name' => 'shippingConditions',
                    'severity' => 'required',
                    'supportedTypes' => [
                        'ShippingConditions',
                    ],
                    'properties' => [
                        'doesNotShip' => [
                            'name' => 'doesNotShip',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'Boolean',
                            ],
                        ],
                        'numItems' => [
                            'name' => 'numItems',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'QuantitativeValue',
                            ],
                            'properties' => [
                                'maxValue' => [
                                    'name' => 'maxValue',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                                'minValue' => [
                                    'name' => 'minValue',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                                'unitCode' => [
                                    'name' => 'unitCode',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                        'orderValue' => [
                            'name' => 'orderValue',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'MonetaryAmount',
                            ],
                            'properties' => [
                                'currency' => [
                                    'name' => 'currency',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'atLeastOneOf' => [
                                    'name' => 'atLeastOneOf',
                                    'severity' => 'required',
                                    'value' => [
                                        'minValue' => true,
                                        'maxValue' => true,
                                    ],
                                    'supportedTypes' => [
                                    ],
                                ],
                                'minValue' => [
                                    'name' => 'minValue',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                                'maxValue' => [
                                    'name' => 'maxValue',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                            ],
                        ],
                        'shippingDestination' => [
                            'name' => 'shippingDestination',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'DefinedRegion',
                            ],
                            'properties' => [
                                'addressCountry' => [
                                    'name' => 'addressCountry',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'addressRegion' => [
                                    'name' => 'addressRegion',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'postalCode' => [
                                    'name' => 'postalCode',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                        'shippingOrigin' => [
                            'name' => 'shippingOrigin',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'DefinedRegion',
                            ],
                            'properties' => [
                                'addressCountry' => [
                                    'name' => 'addressCountry',
                                    'severity' => 'required',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'addressRegion' => [
                                    'name' => 'addressRegion',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                                'postalCode' => [
                                    'name' => 'postalCode',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                        'seasonalOverride' => [
                            'name' => 'seasonalOverride',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'OpeningHoursSpecification',
                            ],
                            'properties' => [
                                'validFrom' => [
                                    'name' => 'validFrom',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Date',
                                    ],
                                ],
                                'validThrough' => [
                                    'name' => 'validThrough',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Date',
                                    ],
                                ],
                            ],
                        ],
                        'shippingRate' => [
                            'name' => 'shippingRate',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'MonetaryAmount',
                                'ShippingRateSettings',
                            ],
                            'properties' => [
                                [
                                    '@target' => 'MonetaryAmount',
                                    'properties' => [
                                        'currency' => [
                                            'name' => 'currency',
                                            'severity' => 'required',
                                            'supportedTypes' => [
                                                'Text',
                                            ],
                                        ],
                                        'atLeastOneOf' => [
                                            'name' => 'atLeastOneOf',
                                            'severity' => 'required',
                                            'value' => [
                                                'value' => true,
                                                'maxValue' => true,
                                            ],
                                            'supportedTypes' => [
                                            ],
                                        ],
                                        'value' => [
                                            'name' => 'value',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'maxValue' => [
                                            'name' => 'maxValue',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                    ],
                                ],
                                [
                                    '@target' => 'ShippingRateSettings',
                                    'properties' => [
                                        'atLeastOneOf' => [
                                            'name' => 'atLeastOneOf',
                                            'severity' => 'recommended',
                                            'value' => [
                                                'orderPercentage' => true,
                                                'weightPercentage' => true,
                                            ],
                                            'supportedTypes' => [
                                            ],
                                        ],
                                        'orderPercentage' => [
                                            'name' => 'orderPercentage',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'weightPercentage' => [
                                            'name' => 'weightPercentage',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'transitTime' => [
                            'name' => 'transitTime',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'ServicePeriod',
                            ],
                            'properties' => [
                                'businessDays' => [
                                    'name' => 'businessDays',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'DayOfWeek',
                                    ],
                                ],
                                'duration' => [
                                    'name' => 'duration',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'QuantitativeValue',
                                    ],
                                    'properties' => [
                                        'atLeastOneOf' => [
                                            'name' => 'atLeastOneOf',
                                            'severity' => 'recommended',
                                            'value' => [
                                                'maxValue' => true,
                                                'value' => true,
                                            ],
                                            'supportedTypes' => [
                                            ],
                                        ],
                                        'maxValue' => [
                                            'name' => 'maxValue',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'minValue' => [
                                            'name' => 'minValue',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'value' => [
                                            'name' => 'value',
                                            'severity' => 'optional',
                                            'supportedTypes' => [
                                                'Number',
                                            ],
                                        ],
                                        'unitCode' => [
                                            'name' => 'unitCode',
                                            'severity' => 'recommended',
                                            'supportedTypes' => [
                                                'Text',
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'weight' => [
                            'name' => 'weight',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'QuantitativeValue',
                            ],
                            'properties' => [
                                'maxValue' => [
                                    'name' => 'maxValue',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                                'minValue' => [
                                    'name' => 'minValue',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                                'unitCode' => [
                                    'name' => 'unitCode',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'name' => [
                    'name' => 'name',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'description' => [
                    'name' => 'description',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'fulfillmentType' => [
                    'name' => 'fulfillmentType',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'FulfillmentTypeEnumeration',
                    ],
                ],
                'handlingTime' => [
                    'name' => 'handlingTime',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'ServicePeriod',
                    ],
                    'properties' => [
                        'businessDays' => [
                            'name' => 'businessDays',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'DayOfWeek',
                            ],
                        ],
                        'cutoffTime' => [
                            'name' => 'cutoffTime',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'Time',
                            ],
                        ],
                        'duration' => [
                            'name' => 'duration',
                            'severity' => 'optional',
                            'supportedTypes' => [
                                'QuantitativeValue',
                            ],
                            'properties' => [
                                'atLeastOneOf' => [
                                    'name' => 'atLeastOneOf',
                                    'severity' => 'recommended',
                                    'value' => [
                                        'maxValue' => true,
                                        'value' => true,
                                    ],
                                    'supportedTypes' => [
                                    ],
                                ],
                                'maxValue' => [
                                    'name' => 'maxValue',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                                'minValue' => [
                                    'name' => 'minValue',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                                'value' => [
                                    'name' => 'value',
                                    'severity' => 'optional',
                                    'supportedTypes' => [
                                        'Number',
                                    ],
                                ],
                                'unitCode' => [
                                    'name' => 'unitCode',
                                    'severity' => 'recommended',
                                    'supportedTypes' => [
                                        'Text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                'validForMemberTier' => [
                    'name' => 'validForMemberTier',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'MemberProgramTier',
                    ],
                ],
            ],
        ],
        'iso6523Code' => [
            'name' => 'iso6523Code',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'legalName' => [
            'name' => 'legalName',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'leiCode' => [
            'name' => 'leiCode',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'logo' => [
            'name' => 'logo',
            'severity' => 'optional',
            'supportedTypes' => [
                'URL',
                'ImageObject',
            ],
        ],
        'naics' => [
            'name' => 'naics',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'name' => [
            'name' => 'name',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'numberOfEmployees' => [
            'name' => 'numberOfEmployees',
            'severity' => 'optional',
            'supportedTypes' => [
                'QuantitativeValue',
            ],
            'properties' => [
                'value' => [
                    'name' => 'value',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
                'minValue' => [
                    'name' => 'minValue',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
                'maxValue' => [
                    'name' => 'maxValue',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
            ],
        ],
        'sameAs' => [
            'name' => 'sameAs',
            'severity' => 'optional',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'taxID' => [
            'name' => 'taxID',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'telephone' => [
            'name' => 'telephone',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'url' => [
            'name' => 'url',
            'severity' => 'optional',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'vatID' => [
            'name' => 'vatID',
            'severity' => 'optional',
            'supportedTypes' => [
                'Text',
            ],
        ],
    ];
}
