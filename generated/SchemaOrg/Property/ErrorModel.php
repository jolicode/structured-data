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

final class ErrorModel
{
    public const DESCRIPTION = 'For failed actions, more information on the cause of the failure.';
    public const LABEL = 'error';
    public const NAME = 'schema:error';
    public const VALUES = ['ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const TYPES = ['Action' => 'SchemaOrg\\Type\\ActionModel'];
}
