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

final class ReviewedByModel
{
    public const DESCRIPTION = 'People or organizations that have reviewed the content on this web page for accuracy and/or completeness.';
    public const LABEL = 'reviewedBy';
    public const NAME = 'schema:reviewedBy';
    public const VALUES = ['OrganizationModel' => 'SchemaOrg\\Type\\OrganizationModel', 'PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['WebPage' => 'SchemaOrg\\Type\\WebPageModel'];
}
