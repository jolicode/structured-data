<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class FundedItemModel
{
    public const DESCRIPTION = 'Indicates something directly or indirectly funded or sponsored through a [[Grant]]. See also [[ownershipFundingInfo]].';
    public const LABEL = 'fundedItem';
    public const NAME = 'schema:fundedItem';
    public const VALUES = ['BioChemEntityModel' => 'SchemaOrg\\Type\\BioChemEntityModel', 'CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel', 'EventModel' => 'SchemaOrg\\Type\\EventModel', 'MedicalEntityModel' => 'SchemaOrg\\Type\\MedicalEntityModel', 'OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel', 'ProductModel' => 'SchemaOrg\\Type\\ProductModel'];
    public const TYPES = ['Grant' => 'SchemaOrg\\Type\\GrantModel'];
}
