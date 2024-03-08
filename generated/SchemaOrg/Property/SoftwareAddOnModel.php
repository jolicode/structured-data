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

final class SoftwareAddOnModel
{
    public const DESCRIPTION = 'Additional content for a software application.';
    public const LABEL = 'softwareAddOn';
    public const NAME = 'schema:softwareAddOn';
    public const VALUES = ['SoftwareApplicationModel' => 'SchemaOrg\\Type\\SoftwareApplicationModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\\Type\\SoftwareApplicationModel'];
}
