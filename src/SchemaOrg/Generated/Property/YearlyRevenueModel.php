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

final class YearlyRevenueModel
{
    public const DESCRIPTION = 'The size of the business in annual revenue.';
    public const LABEL = 'yearlyRevenue';
    public const NAME = 'schema:yearlyRevenue';
    public const VALUES = ['QuantitativeValueModel' => 'Jolicode\SchemaOrg\Type\QuantitativeValueModel'];
    public const TYPES = ['BusinessAudience' => 'Jolicode\SchemaOrg\Type\BusinessAudienceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
