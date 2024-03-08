<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class BranchModel
{
    public const DESCRIPTION = 'The branches that delineate from the nerve bundle. Not to be confused with [[branchOf]].';
    public const LABEL = 'branch';
    public const NAME = 'schema:branch';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['Nerve' => 'SchemaOrg\Type\NerveModel'];
}
