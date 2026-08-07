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

final class IncentiveStatusModel
{
    public const DESCRIPTION = 'The status of the incentive (active, on hold, retired, etc.).';
    public const LABEL = 'incentiveStatus';
    public const NAME = 'schema:incentiveStatus';
    public const VALUES = ['IncentiveStatusModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\IncentiveStatusModel'];
    public const TYPES = ['FinancialIncentive' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\FinancialIncentiveModel'];
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3572'];
    public const SUPERSEDED_BY = null;
}
