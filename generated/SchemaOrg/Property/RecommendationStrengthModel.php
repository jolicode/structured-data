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

final class RecommendationStrengthModel
{
    public const DESCRIPTION = 'Strength of the guideline\'s recommendation (e.g. \'class I\').';
    public const LABEL = 'recommendationStrength';
    public const NAME = 'schema:recommendationStrength';
    public const VALUES = ['TextModel' => 'SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalGuidelineRecommendation' => 'SchemaOrg\Type\MedicalGuidelineRecommendationModel'];
}
