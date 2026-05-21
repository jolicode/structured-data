<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\Google;

final class Organization
{
    public const NAME = 'Organization';
    public const SUPPORTED_TYPES = ['Organization', 'OnlineStore'];
    public const VALUE = [];
    public const DOCUMENTATION = 'https://developers.google.com/search/docs/appearance/structured-data/organization';
    public const SUBTYPE = null;
    public const HAS_SPECIAL_RULES = true;
    public const SPECIAL_RULE_KEYS = ['google.organization.return_policy_merchant_return_days_when_finite', 'google.organization.tax_id_country_consistency'];
    public const IS_CAROUSEL_ELIGIBLE = false;
    public const CAROUSEL_PROPERTIES = [];
    public const PROPERTIES = [
        'address' => [
            'name' => 'address',
            'severity' => 'recommended',
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
                    'severity' => 'recommended',
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
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'contactPoint' => [
            'name' => 'contactPoint',
            'severity' => 'recommended',
            'supportedTypes' => [
                'ContactPoint',
            ],
            'properties' => [
                'email' => [
                    'name' => 'email',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'telephone' => [
                    'name' => 'telephone',
                    'severity' => 'recommended',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
            ],
        ],
        'description' => [
            'name' => 'description',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'duns' => [
            'name' => 'duns',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'email' => [
            'name' => 'email',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'foundingDate' => [
            'name' => 'foundingDate',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Date',
            ],
        ],
        'globalLocationNumber' => [
            'name' => 'globalLocationNumber',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'hasMerchantReturnPolicy' => [
            'name' => 'hasMerchantReturnPolicy',
            'severity' => 'recommended',
            'documentation' => 'https://developers.google.com/search/docs/appearance/structured-data/return-policy',
            'supportedTypes' => [
                'MerchantReturnPolicy',
            ],
            'properties' => [
                'atLeastOneOf' => [
                    'name' => 'atLeastOneOf',
                    'severity' => 'required',
                    'value' => [
                        'merchantReturnLink' => [
                        ],
                        'returnPolicyCategory' => [
                        ],
                    ],
                ],
                'applicableCountry' => [
                    'name' => 'applicableCountry',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Text',
                    ],
                ],
                'merchantReturnLink' => [
                    'name' => 'merchantReturnLink',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'URL',
                    ],
                ],
                'returnPolicyCategory' => [
                    'name' => 'returnPolicyCategory',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'MerchantReturnEnumeration',
                    ],
                ],
                'merchantReturnDays' => [
                    'name' => 'merchantReturnDays',
                    'severity' => 'optional',
                    'supportedTypes' => [
                        'Integer',
                    ],
                ],
            ],
        ],
        'hasMemberProgram' => [
            'name' => 'hasMemberProgram',
            'severity' => 'recommended',
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
                    ],
                ],
            ],
        ],
        'hasShippingService' => [
            'name' => 'hasShippingService',
            'severity' => 'recommended',
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
                ],
            ],
        ],
        'iso6523Code' => [
            'name' => 'iso6523Code',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'legalName' => [
            'name' => 'legalName',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'leiCode' => [
            'name' => 'leiCode',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'logo' => [
            'name' => 'logo',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
                'ImageObject',
            ],
        ],
        'naics' => [
            'name' => 'naics',
            'severity' => 'recommended',
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
            'severity' => 'recommended',
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
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'taxID' => [
            'name' => 'taxID',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'telephone' => [
            'name' => 'telephone',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
        'url' => [
            'name' => 'url',
            'severity' => 'recommended',
            'supportedTypes' => [
                'URL',
            ],
        ],
        'vatID' => [
            'name' => 'vatID',
            'severity' => 'recommended',
            'supportedTypes' => [
                'Text',
            ],
        ],
    ];
}
