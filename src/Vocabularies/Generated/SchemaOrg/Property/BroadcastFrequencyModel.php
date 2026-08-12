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

final class BroadcastFrequencyModel
{
    public const DESCRIPTION = 'The frequency used for over-the-air broadcasts. Numeric values or simple ranges, e.g. 87-99. In addition a shortcut idiom is supported for frequencies of AM and FM radio channels, e.g. "87 FM".';
    public const LABEL = 'broadcastFrequency';
    public const NAME = 'schema:broadcastFrequency';
    public const VALUES = ['BroadcastFrequencySpecificationModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BroadcastFrequencySpecificationModel', 'TextModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['BroadcastChannel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BroadcastChannelModel', 'BroadcastService' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\BroadcastServiceModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/1004'];
    public const SUPERSEDED_BY = null;
}
