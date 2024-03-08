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

final class CandidateModel
{
    public const DESCRIPTION = 'A sub property of object. The candidate subject of this action.';
    public const LABEL = 'candidate';
    public const NAME = 'schema:candidate';
    public const VALUES = ['PersonModel' => 'SchemaOrg\\Type\\PersonModel'];
    public const TYPES = ['VoteAction' => 'SchemaOrg\\Type\\VoteActionModel'];
}
