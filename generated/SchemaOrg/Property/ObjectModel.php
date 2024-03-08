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

final class ObjectModel
{
    public const DESCRIPTION = 'The object upon which the action is carried out, whose state is kept intact or changed. Also known as the semantic roles patient, affected or undergoer (which change their state) or theme (which doesn\'t). E.g. John read *a book*.';
    public const LABEL = 'object';
    public const NAME = 'schema:object';
    public const VALUES = ['ThingModel' => 'SchemaOrg\\Type\\ThingModel'];
    public const TYPES = ['Action' => 'SchemaOrg\\Type\\ActionModel'];
}
