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

final class StepModel
{
    public const DESCRIPTION = 'A single step item (as HowToStep, text, document, video, etc.) or a HowToSection.';
    public const LABEL = 'step';
    public const NAME = 'schema:step';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'HowToSectionModel' => 'Jolicode\SchemaOrg\Type\HowToSectionModel', 'HowToStepModel' => 'Jolicode\SchemaOrg\Type\HowToStepModel', 'TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowTo' => 'Jolicode\SchemaOrg\Type\HowToModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
