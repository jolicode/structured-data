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

final class JobImmediateStartModel
{
    public const DESCRIPTION = 'An indicator as to whether a position is available for an immediate start.';
    public const LABEL = 'jobImmediateStart';
    public const NAME = 'schema:jobImmediateStart';
    public const VALUES = ['BooleanModel' => 'SchemaOrg\\Type\\BooleanModel'];
    public const TYPES = ['JobPosting' => 'SchemaOrg\\Type\\JobPostingModel'];
}
