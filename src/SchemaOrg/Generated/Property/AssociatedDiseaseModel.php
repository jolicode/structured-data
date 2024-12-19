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

final class AssociatedDiseaseModel
{
    public const DESCRIPTION = 'Disease associated to this BioChemEntity. Such disease can be a MedicalCondition or a URL. If you want to add an evidence supporting the association, please use PropertyValue.';
    public const LABEL = 'associatedDisease';
    public const NAME = 'schema:associatedDisease';
    public const VALUES = ['MedicalConditionModel' => 'Jolicode\SchemaOrg\Type\MedicalConditionModel', 'PropertyValueModel' => 'Jolicode\SchemaOrg\Type\PropertyValueModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['BioChemEntity' => 'Jolicode\SchemaOrg\Type\BioChemEntityModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
