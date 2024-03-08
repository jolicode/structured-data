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

final class ApplicationSuiteModel
{
    public const DESCRIPTION = 'The name of the application suite to which the application belongs (e.g. Excel belongs to Office).';
    public const LABEL = 'applicationSuite';
    public const NAME = 'schema:applicationSuite';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\\Type\\SoftwareApplicationModel'];
}
