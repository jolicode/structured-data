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

final class GuidelineSubjectModel
{
    public const DESCRIPTION = 'The medical conditions, treatments, etc. that are the subject of the guideline.';
    public const LABEL = 'guidelineSubject';
    public const NAME = 'schema:guidelineSubject';
    public const VALUES = ['MedicalEntityModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalEntityModel'];
    public const TYPES = ['MedicalGuideline' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalGuidelineModel'];
    public const IS_PART_OF = ['https://health-lifesci.schema.org'];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
