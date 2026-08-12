<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class StepsModel
{
    public const DESCRIPTION = 'A single step item (as HowToStep, text, document, video, etc.) or a HowToSection (originally misnamed \'steps\'; \'step\' is preferred).';
    public const LABEL = 'steps';
    public const NAME = 'schema:steps';
    public const VALUES = ['CreativeWorkModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel', 'ItemListModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ItemListModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HowTo' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HowToModel', 'HowToSection' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\HowToSectionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'step';
}
