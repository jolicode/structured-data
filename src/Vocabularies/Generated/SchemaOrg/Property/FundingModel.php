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

final class FundingModel
{
    public const DESCRIPTION = 'A [[Grant]] that directly or indirectly provide funding or sponsorship for this item. See also [[ownershipFundingInfo]].';
    public const LABEL = 'funding';
    public const NAME = 'schema:funding';
    public const VALUES = ['GrantModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\GrantModel'];
    public const TYPES = ['BioChemEntity' => 'Jolicode\Vocabularies\SchemaOrg\Type\BioChemEntityModel', 'CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel', 'MedicalEntity' => 'Jolicode\Vocabularies\SchemaOrg\Type\MedicalEntityModel', 'Organization' => 'Jolicode\Vocabularies\SchemaOrg\Type\OrganizationModel', 'Person' => 'Jolicode\Vocabularies\SchemaOrg\Type\PersonModel', 'Product' => 'Jolicode\Vocabularies\SchemaOrg\Type\ProductModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
