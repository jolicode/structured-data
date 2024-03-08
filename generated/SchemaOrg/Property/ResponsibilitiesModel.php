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

final class ResponsibilitiesModel
{
    public const DESCRIPTION = 'Responsibilities associated with this role or Occupation.';
    public const LABEL = 'responsibilities';
    public const NAME = 'schema:responsibilities';
    public const VALUES = ['TextModel' => 'SchemaOrg\\Type\\TextModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\\Type\\JobPostingModel', 'Occupation' => 'SchemaOrg\\Type\\OccupationModel'];
}
