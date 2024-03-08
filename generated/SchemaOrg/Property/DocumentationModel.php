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

final class DocumentationModel
{
    public const DESCRIPTION = 'Further documentation describing the Web API in more detail.';
    public const LABEL = 'documentation';
    public const NAME = 'schema:documentation';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['WebAPI' => 'SchemaOrg\\Type\\WebAPIModel'];
}
