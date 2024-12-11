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

final class AfterMediaModel
{
    public const DESCRIPTION = 'A media object representing the circumstances after performing this direction.';
    public const LABEL = 'afterMedia';
    public const NAME = 'schema:afterMedia';
    public const VALUES = ['MediaObjectModel' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['HowToDirection' => 'Jolicode\SchemaOrg\Type\HowToDirectionModel'];
}
