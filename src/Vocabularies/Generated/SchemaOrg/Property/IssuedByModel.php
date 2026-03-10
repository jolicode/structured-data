<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class IssuedByModel
{
    public const DESCRIPTION = 'The organization issuing the item, for example a [[Permit]], [[Ticket]], or [[Certification]].';
    public const LABEL = 'issuedBy';
    public const NAME = 'schema:issuedBy';
    public const VALUES = ['OrganizationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['Certification' => 'Jolicode\Vocabularies\SchemaOrg\Type\CertificationModel', 'Permit' => 'Jolicode\Vocabularies\SchemaOrg\Type\PermitModel', 'Ticket' => 'Jolicode\Vocabularies\SchemaOrg\Type\TicketModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
