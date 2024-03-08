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

final class ApplicationModel
{
    public const DESCRIPTION = 'An application that can complete the request.';
    public const LABEL = 'application';
    public const NAME = 'schema:application';
    public const VALUES = ['SoftwareApplicationModel' => 'SchemaOrg\Type\SoftwareApplicationModel'];
    public const TYPES = ['EntryPoint' => 'SchemaOrg\Type\EntryPointModel'];
}
