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

final class GuidelineModel
{
    public const DESCRIPTION = 'A medical guideline related to this entity.';
    public const LABEL = 'guideline';
    public const NAME = 'schema:guideline';
    public const VALUES = ['MedicalGuidelineModel' => 'SchemaOrg\Type\MedicalGuidelineModel'];
    public const TYPES = ['MedicalEntity' => 'SchemaOrg\Type\MedicalEntityModel'];
}
