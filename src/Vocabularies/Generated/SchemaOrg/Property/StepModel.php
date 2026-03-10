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

final class StepModel
{
    public const DESCRIPTION = 'A single step item (as HowToStep, text, document, video, etc.) or a HowToSection.';
    public const LABEL = 'step';
    public const NAME = 'schema:step';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'HowToSectionModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToSectionModel', 'HowToStepModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToStepModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowTo' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
