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

final class StepsModel
{
    public const DESCRIPTION = 'A single step item (as HowToStep, text, document, video, etc.) or a HowToSection (originally misnamed \'steps\'; \'step\' is preferred).';
    public const LABEL = 'steps';
    public const NAME = 'schema:steps';
    public const VALUES = ['CreativeWorkModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'ItemListModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ItemListModel', 'TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowTo' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToModel', 'HowToSection' => 'Jolicode\Vocabularies\SchemaOrg\Type\HowToSectionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
