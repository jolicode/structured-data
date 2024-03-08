<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class StepModel
{
    public const DESCRIPTION = 'A single step item (as HowToStep, text, document, video, etc.) or a HowToSection.';
    public const LABEL = 'step';
    public const NAME = 'schema:step';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel', 'HowToSectionModel' => 'SchemaOrg\\Type\\HowToSectionModel', 'HowToStepModel' => 'SchemaOrg\\Type\\HowToStepModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['HowTo' => 'SchemaOrg\\Type\\HowToModel'];
}
