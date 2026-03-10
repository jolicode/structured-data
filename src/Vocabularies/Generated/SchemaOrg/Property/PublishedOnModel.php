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

final class PublishedOnModel
{
    public const DESCRIPTION = 'A broadcast service associated with the publication event.';
    public const LABEL = 'publishedOn';
    public const NAME = 'schema:publishedOn';
    public const VALUES = ['BroadcastServiceModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\BroadcastServiceModel'];
    public const TYPES = ['PublicationEvent' => 'Jolicode\Vocabularies\SchemaOrg\Type\PublicationEventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
