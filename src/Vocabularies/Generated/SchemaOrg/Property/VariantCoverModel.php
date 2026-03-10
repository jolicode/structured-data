<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\SchemaOrg\Property;

final class VariantCoverModel
{
    public const DESCRIPTION = 'A description of the variant cover
    	for the issue, if the issue is a variant printing. For example, "Bryan Hitch
    	Variant Cover" or "2nd Printing Variant".';
    public const LABEL = 'variantCover';
    public const NAME = 'schema:variantCover';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\TextModel'];
    public const TYPES = ['ComicIssue' => 'Jolicode\Vocabularies\SchemaOrg\Type\ComicIssueModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
