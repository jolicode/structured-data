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

final class LenderModel
{
    public const DESCRIPTION = 'A sub property of participant. The person that lends the object being borrowed.';
    public const LABEL = 'lender';
    public const NAME = 'schema:lender';
    public const VALUES = ['OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel'];
    public const TYPES = ['BorrowAction' => 'Jolicode\SchemaOrg\Type\BorrowActionModel'];
}
