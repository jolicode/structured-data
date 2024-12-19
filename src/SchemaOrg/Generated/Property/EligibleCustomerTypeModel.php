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

final class EligibleCustomerTypeModel
{
    public const DESCRIPTION = 'The type(s) of customers for which the given offer is valid.';
    public const LABEL = 'eligibleCustomerType';
    public const NAME = 'schema:eligibleCustomerType';
    public const VALUES = ['BusinessEntityTypeModel' => 'Jolicode\SchemaOrg\Type\BusinessEntityTypeModel'];
    public const TYPES = ['Demand' => 'Jolicode\SchemaOrg\Type\DemandModel', 'Offer' => 'Jolicode\SchemaOrg\Type\OfferModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
