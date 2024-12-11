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

final class CommentTextModel
{
    public const DESCRIPTION = 'The text of the UserComment.';
    public const LABEL = 'commentText';
    public const NAME = 'schema:commentText';
    public const VALUES = ['TextModel' => 'Jolicode\SchemaOrg\Type\TextModel'];
    public const TYPES = ['UserComments' => 'Jolicode\SchemaOrg\Type\UserCommentsModel'];
}
