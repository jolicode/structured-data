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

final class InstallUrlModel
{
    public const DESCRIPTION = 'URL at which the app may be installed, if different from the URL of the item.';
    public const LABEL = 'installUrl';
    public const NAME = 'schema:installUrl';
    public const VALUES = ['URLModel' => 'SchemaOrg\Type\URLModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\Type\SoftwareApplicationModel'];
}
