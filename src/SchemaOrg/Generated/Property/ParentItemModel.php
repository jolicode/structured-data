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

final class ParentItemModel
{
    public const DESCRIPTION = 'The parent of a question, answer or item in general.';
    public const LABEL = 'parentItem';
    public const NAME = 'schema:parentItem';
    public const VALUES = ['CommentModel' => 'Jolicode\SchemaOrg\Type\CommentModel'];
    public const TYPES = ['Comment' => 'Jolicode\SchemaOrg\Type\CommentModel'];
}
