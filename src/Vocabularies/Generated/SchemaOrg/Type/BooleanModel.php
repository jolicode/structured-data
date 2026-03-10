<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Type;

final class BooleanModel
{
    public const DESCRIPTION = 'Boolean: True or False.';
    public const LABEL = 'Boolean';
    public const NAME = 'schema:Boolean';
    public const PARENTS = [];
    public const ENUMERATION_MEMBERS = ['FalseModel' => 'EnumerationMember\FalseModel', 'TrueModel' => 'EnumerationMember\TrueModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];

    public function __construct()
    {
    }
}
