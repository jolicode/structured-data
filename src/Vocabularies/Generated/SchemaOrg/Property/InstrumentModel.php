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

final class InstrumentModel
{
    public const DESCRIPTION = 'The object that helped the agent perform the action. E.g. John wrote a book with *a pen*.';
    public const LABEL = 'instrument';
    public const NAME = 'schema:instrument';
    public const VALUES = ['ThingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Action' => 'Jolicode\Vocabularies\SchemaOrg\Type\ActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
