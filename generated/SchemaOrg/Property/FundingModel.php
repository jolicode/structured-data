<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class FundingModel
{
    public const DESCRIPTION = 'A [[Grant]] that directly or indirectly provide funding or sponsorship for this item. See also [[ownershipFundingInfo]].';
    public const LABEL = 'funding';
    public const NAME = 'schema:funding';
    public const VALUES = ['GrantModel' => 'SchemaOrg\Type\GrantModel'];
    public const TYPES = ['BioChemEntity' => 'SchemaOrg\Type\BioChemEntityModel', 'CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel', 'Event' => 'SchemaOrg\Type\EventModel', 'MedicalEntity' => 'SchemaOrg\Type\MedicalEntityModel', 'Organization' => 'SchemaOrg\Type\OrganizationModel', 'Person' => 'SchemaOrg\Type\PersonModel', 'Product' => 'SchemaOrg\Type\ProductModel'];
}
