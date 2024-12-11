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

final class IssuedByModel
{
    public const DESCRIPTION = 'The organization issuing the ticket or permit.';
    public const LABEL = 'issuedBy';
    public const NAME = 'schema:issuedBy';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel'];
    public const TYPES = ['Permit' => 'Jolicode\SchemaOrg\Type\PermitModel', 'Ticket' => 'Jolicode\SchemaOrg\Type\TicketModel'];
}
