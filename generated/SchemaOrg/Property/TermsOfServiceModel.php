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

final class TermsOfServiceModel
{
    public const DESCRIPTION = 'Human-readable terms of service documentation.';
    public const LABEL = 'termsOfService';
    public const NAME = 'schema:termsOfService';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['Service' => 'SchemaOrg\\Type\\ServiceModel'];
}
