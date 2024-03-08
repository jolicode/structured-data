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

final class MastheadModel
{
    public const DESCRIPTION = 'For a [[NewsMediaOrganization]], a link to the masthead page or a page listing top editorial management.';
    public const LABEL = 'masthead';
    public const NAME = 'schema:masthead';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel', 'URLModel' => 'SchemaOrg\\Type\\URLModel'];
    public const TYPES = ['NewsMediaOrganization' => 'SchemaOrg\\Type\\NewsMediaOrganizationModel'];
}
