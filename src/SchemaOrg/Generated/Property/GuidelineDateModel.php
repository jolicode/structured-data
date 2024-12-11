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

final class GuidelineDateModel
{
    public const DESCRIPTION = 'Date on which this guideline\'s recommendation was made.';
    public const LABEL = 'guidelineDate';
    public const NAME = 'schema:guidelineDate';
    public const VALUES = ['DateModel' => 'Jolicode\SchemaOrg\Type\DateModel'];
    public const TYPES = ['MedicalGuideline' => 'Jolicode\SchemaOrg\Type\MedicalGuidelineModel'];
}
