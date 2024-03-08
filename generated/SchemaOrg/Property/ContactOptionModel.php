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

final class ContactOptionModel
{
    public const DESCRIPTION = 'An option available on this contact point (e.g. a toll-free number or support for hearing-impaired callers).';
    public const LABEL = 'contactOption';
    public const NAME = 'schema:contactOption';
    public const VALUES = ['ContactPointOptionModel' => 'SchemaOrg\\Type\\ContactPointOptionModel'];
    public const TYPES = ['ContactPoint' => 'SchemaOrg\\Type\\ContactPointModel'];
}
