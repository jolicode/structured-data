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

final class AdministrationRouteModel
{
    public const DESCRIPTION = 'A route by which this drug may be administered, e.g. \'oral\'.';
    public const LABEL = 'administrationRoute';
    public const NAME = 'schema:administrationRoute';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Drug' => 'Jolicode\SchemaOrg\Type\DrugModel'];
}
