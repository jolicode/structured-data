<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\EnumerationMember;

final class IncentiveStatusOnHoldModel
{
    public const DESCRIPTION = 'This incentive is currently active, but may not be accepting new applicants (e.g. max number of redemptions reached for a year)';
    public const LABEL = 'IncentiveStatusOnHold';
    public const NAME = 'schema:IncentiveStatusOnHold';
    public const IS_PART_OF = ['https://pending.schema.org'];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3572'];
    public const SUPERSEDED_BY = null;
}
