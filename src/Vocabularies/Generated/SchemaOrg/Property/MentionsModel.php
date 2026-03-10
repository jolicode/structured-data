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

final class MentionsModel
{
    public const DESCRIPTION = 'Indicates that the CreativeWork contains a reference to, but is not necessarily about a concept.';
    public const LABEL = 'mentions';
    public const NAME = 'schema:mentions';
    public const VALUES = ['ThingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
