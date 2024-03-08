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

final class ParentItemModel
{
    public const DESCRIPTION = 'The parent of a question, answer or item in general.';
    public const LABEL = 'parentItem';
    public const NAME = 'schema:parentItem';
    public const VALUES = ['CommentModel' => 'SchemaOrg\\Type\\CommentModel'];
    public const TYPES = ['Comment' => 'SchemaOrg\\Type\\CommentModel'];
}
