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

final class CountriesNotSupportedModel
{
    public const DESCRIPTION = 'Countries for which the application is not supported. You can also provide the two-letter ISO 3166-1 alpha-2 country code.';
    public const LABEL = 'countriesNotSupported';
    public const NAME = 'schema:countriesNotSupported';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['SoftwareApplication' => 'SchemaOrg\\Type\\SoftwareApplicationModel'];
}
