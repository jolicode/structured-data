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

final class IncentivizedItemModel
{
    public const DESCRIPTION = 'The type or specific product(s) and/or service(s) being incentivized.
<p>DefinedTermSets are used for product and service categories such as the United Nations Standard Products and Services Code:</p>
    {
        "@type": "DefinedTerm",
        "inDefinedTermSet": "https://www.unspsc.org/",
        "termCode": "261315XX",
        "name": "Photovoltaic module"
    }

<p>For a specific product or service, use the Product type:</p>
    {
        "@type": "Product",
        "name": "Kenmore White 17" Microwave",
    }
For multiple different incentivized items, use multiple [[DefinedTerm]] or [[Product]].';
    public const LABEL = 'incentivizedItem';
    public const NAME = 'schema:incentivizedItem';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\SchemaOrg\Type\DefinedTermModel', 'ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
