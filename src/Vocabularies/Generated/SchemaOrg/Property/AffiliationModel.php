<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class AffiliationModel
{
    public const DESCRIPTION = 'An organization that this person is affiliated with. For example, a school/university, a club, or a team.';
    public const LABEL = 'affiliation';
    public const NAME = 'schema:affiliation';
    public const VALUES = ['OrganizationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['Person' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\PersonModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
