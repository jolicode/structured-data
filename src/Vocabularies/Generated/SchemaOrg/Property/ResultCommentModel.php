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

final class ResultCommentModel
{
    public const DESCRIPTION = 'A sub property of result. The Comment created or sent as a result of this action.';
    public const LABEL = 'resultComment';
    public const NAME = 'schema:resultComment';
    public const VALUES = ['CommentModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CommentModel'];
    public const TYPES = ['CommentAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\CommentActionModel', 'ReplyAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\ReplyActionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
