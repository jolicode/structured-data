<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ActionProcessModel
{
    public const DESCRIPTION = 'Description of the process by which the action was performed.';
    public const LABEL = 'actionProcess';
    public const NAME = 'schema:actionProcess';
    public const VALUES = ['HowToModel' => 'Jolicode\SchemaOrg\Type\HowToModel'];
    public const TYPES = ['Action' => 'Jolicode\SchemaOrg\Type\ActionModel'];
}
