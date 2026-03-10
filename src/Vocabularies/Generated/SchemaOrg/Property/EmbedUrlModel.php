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

final class EmbedUrlModel
{
    public const DESCRIPTION = 'A URL pointing to a player for a specific video. In general, this is the information in the ```src``` element of an ```embed``` tag and should not be the same as the content of the ```loc``` tag.';
    public const LABEL = 'embedUrl';
    public const NAME = 'schema:embedUrl';
    public const VALUES = ['URLModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\URLModel'];
    public const TYPES = ['MediaObject' => 'Jolicode\Vocabularies\SchemaOrg\Type\MediaObjectModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
