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

final class UtterancesModel
{
    public const DESCRIPTION = 'Text of an utterances (spoken words, lyrics etc.) that occurs at a certain section of a media object, represented as a [[HyperTocEntry]].';
    public const LABEL = 'utterances';
    public const NAME = 'schema:utterances';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['HyperTocEntry' => 'Jolicode\Vocabularies\SchemaOrg\Type\HyperTocEntryModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
