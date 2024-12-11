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

final class FundedItemModel
{
    public const DESCRIPTION = 'Indicates something directly or indirectly funded or sponsored through a [[Grant]]. See also [[ownershipFundingInfo]].';
    public const LABEL = 'fundedItem';
    public const NAME = 'schema:fundedItem';
    public const VALUES = ['BioChemEntityModel' => 'Jolicode\SchemaOrg\Type\BioChemEntityModel', 'CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'EventModel' => 'Jolicode\SchemaOrg\Type\EventModel', 'MedicalEntityModel' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel', 'OrganizationModel' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'PersonModel' => 'Jolicode\SchemaOrg\Type\PersonModel', 'ProductModel' => 'Jolicode\SchemaOrg\Type\ProductModel'];
    public const TYPES = ['Grant' => 'Jolicode\SchemaOrg\Type\GrantModel'];
}
