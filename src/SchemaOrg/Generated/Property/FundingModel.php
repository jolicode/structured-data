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

final class FundingModel
{
    public const DESCRIPTION = 'A [[Grant]] that directly or indirectly provide funding or sponsorship for this item. See also [[ownershipFundingInfo]].';
    public const LABEL = 'funding';
    public const NAME = 'schema:funding';
    public const VALUES = ['GrantModel' => 'Jolicode\SchemaOrg\Type\GrantModel'];
    public const TYPES = ['BioChemEntity' => 'Jolicode\SchemaOrg\Type\BioChemEntityModel', 'CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel', 'MedicalEntity' => 'Jolicode\SchemaOrg\Type\MedicalEntityModel', 'Organization' => 'Jolicode\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\SchemaOrg\Type\PersonModel', 'Product' => 'Jolicode\SchemaOrg\Type\ProductModel'];
}
