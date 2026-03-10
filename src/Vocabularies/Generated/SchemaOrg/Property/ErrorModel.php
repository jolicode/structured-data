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

final class ErrorModel
{
    public const DESCRIPTION = 'For failed actions, more information on the cause of the failure. Consider using the Error type.';
    public const LABEL = 'error';
    public const NAME = 'schema:error';
    public const VALUES = ['ThingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Action' => 'Jolicode\Vocabularies\SchemaOrg\Type\ActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
