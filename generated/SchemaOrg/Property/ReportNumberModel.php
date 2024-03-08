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

final class ReportNumberModel
{
    public const DESCRIPTION = 'The number or other unique designator assigned to a Report by the publishing organization.';
    public const LABEL = 'reportNumber';
    public const NAME = 'schema:reportNumber';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['Report' => 'SchemaOrg\\Type\\ReportModel'];
}
