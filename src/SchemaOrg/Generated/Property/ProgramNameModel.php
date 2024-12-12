<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\SchemaOrg\Property;

final class ProgramNameModel
{
    public const DESCRIPTION = 'The program providing the membership. It is preferable to use [:program](https://schema.org/program) instead.';
    public const LABEL = 'programName';
    public const NAME = 'schema:programName';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ProgramMembership' => 'Jolicode\SchemaOrg\Type\ProgramMembershipModel'];
}
