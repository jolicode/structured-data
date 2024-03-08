<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class ResultModel
{
    public const DESCRIPTION = 'The result produced in the action. E.g. John wrote *a book*.';
    public const LABEL = 'result';
    public const NAME = 'schema:result';
    public const VALUES = ['ThingModel' => 'SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Action' => 'SchemaOrg\Type\ActionModel'];
}
