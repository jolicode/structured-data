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

final class ArterialBranchModel
{
    public const DESCRIPTION = 'The branches that comprise the arterial structure.';
    public const LABEL = 'arterialBranch';
    public const NAME = 'schema:arterialBranch';
    public const VALUES = ['AnatomicalStructureModel' => 'SchemaOrg\Type\AnatomicalStructureModel'];
    public const TYPES = ['Artery' => 'SchemaOrg\Type\ArteryModel'];
}
