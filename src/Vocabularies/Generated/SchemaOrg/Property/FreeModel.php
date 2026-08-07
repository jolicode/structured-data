<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class FreeModel
{
    public const DESCRIPTION = 'A flag to signal that the item, event, or place is accessible for free.';
    public const LABEL = 'free';
    public const NAME = 'schema:free';
    public const VALUES = ['BooleanModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\BooleanModel'];
    public const TYPES = ['PublicationEvent' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\PublicationEventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = 'isAccessibleForFree';
}
