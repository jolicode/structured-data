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

final class ChildMinAgeModel
{
    public const DESCRIPTION = 'Minimal age of the child.';
    public const LABEL = 'childMinAge';
    public const NAME = 'schema:childMinAge';
    public const VALUES = ['NumberModel' => 'SchemaOrg\\Type\\NumberModel'];
    public const TYPES = ['ParentAudience' => 'SchemaOrg\\Type\\ParentAudienceModel'];
}
