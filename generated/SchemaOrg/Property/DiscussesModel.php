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

final class DiscussesModel
{
    public const DESCRIPTION = 'Specifies the CreativeWork associated with the UserComment.';
    public const LABEL = 'discusses';
    public const NAME = 'schema:discusses';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\\Type\\CreativeWorkModel'];
    public const TYPES = ['UserComments' => 'SchemaOrg\\Type\\UserCommentsModel'];
}
