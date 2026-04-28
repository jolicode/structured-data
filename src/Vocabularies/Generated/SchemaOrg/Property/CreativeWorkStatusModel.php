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

final class CreativeWorkStatusModel
{
    public const DESCRIPTION = 'The status of a creative work in terms of its stage in a lifecycle. Example terms include Incomplete, Draft, Published, Obsolete. Some organizations define a set of terms for the stages of their publication lifecycle.';
    public const LABEL = 'creativeWorkStatus';
    public const NAME = 'schema:creativeWorkStatus';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
