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

final class CommentModel
{
    public const DESCRIPTION = 'Comments, typically from users.';
    public const LABEL = 'comment';
    public const NAME = 'schema:comment';
    public const VALUES = ['CommentModel' => 'Jolicode\SchemaOrg\Type\CommentModel'];
    public const TYPES = ['CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'RsvpAction' => 'Jolicode\SchemaOrg\Type\RsvpActionModel'];
}
