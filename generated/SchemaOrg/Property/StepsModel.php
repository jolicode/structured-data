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

final class StepsModel
{
    public const DESCRIPTION = 'A single step item (as HowToStep, text, document, video, etc.) or a HowToSection (originally misnamed \'steps\'; \'step\' is preferred).';
    public const LABEL = 'steps';
    public const NAME = 'schema:steps';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel', 'ItemListModel' => 'SchemaOrg\\Type\\ItemListModel', 'TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['HowTo' => 'SchemaOrg\\Type\\HowToModel', 'HowToSection' => 'SchemaOrg\\Type\\HowToSectionModel'];
}
