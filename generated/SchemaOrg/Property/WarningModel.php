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

final class WarningModel
{
    public const DESCRIPTION = 'Any FDA or other warnings about the drug (text or URL).';
    public const LABEL = 'warning';
    public const NAME = 'schema:warning';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Drug' => 'SchemaOrg\\Type\\DrugModel'];
}
