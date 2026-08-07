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

final class PrimaryPreventionModel
{
    public const DESCRIPTION = 'A preventative therapy used to prevent an initial occurrence of the medical condition, such as vaccination.';
    public const LABEL = 'primaryPrevention';
    public const NAME = 'schema:primaryPrevention';
    public const VALUES = ['MedicalTherapyModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalTherapyModel'];
    public const TYPES = ['MedicalCondition' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalConditionModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
