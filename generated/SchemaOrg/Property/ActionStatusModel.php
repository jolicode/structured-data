<?php

declare(strict_types=1);

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ActionStatusModel
{
    public const DESCRIPTION = 'Indicates the current disposition of the Action.';
    public const LABEL = 'actionStatus';
    public const NAME = 'schema:actionStatus';
    public const VALUES = ['ActionStatusTypeModel' => 'SchemaOrg\\Type\\ActionStatusTypeModel'];
    public const TYPES = ['Action' => 'SchemaOrg\\Type\\ActionModel'];
}
