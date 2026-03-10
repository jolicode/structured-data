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

final class SafetyConsiderationModel
{
    public const DESCRIPTION = 'Any potential safety concern associated with the supplement. May include interactions with other drugs and foods, pregnancy, breastfeeding, known adverse reactions, and documented efficacy of the supplement.';
    public const LABEL = 'safetyConsideration';
    public const NAME = 'schema:safetyConsideration';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['DietarySupplement' => 'Jolicode\Vocabularies\SchemaOrg\Type\DietarySupplementModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
