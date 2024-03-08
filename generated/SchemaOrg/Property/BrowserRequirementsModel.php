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

final class BrowserRequirementsModel
{
    public const DESCRIPTION = 'Specifies browser requirements in human-readable text. For example, \'requires HTML5 support\'.';
    public const LABEL = 'browserRequirements';
    public const NAME = 'schema:browserRequirements';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['WebApplication' => 'SchemaOrg\\Type\\WebApplicationModel'];
}
