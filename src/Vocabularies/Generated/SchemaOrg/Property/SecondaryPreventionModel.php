<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class SecondaryPreventionModel
{
    public const DESCRIPTION = 'A preventative therapy used to prevent reoccurrence of the medical condition after an initial episode of the condition.';
    public const LABEL = 'secondaryPrevention';
    public const NAME = 'schema:secondaryPrevention';
    public const VALUES = ['DrugClassModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DrugClassModel', 'DrugModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DrugModel', 'LifestyleModificationModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\LifestyleModificationModel', 'MedicalTherapyModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
