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

final class BeforeMediaModel
{
    public const DESCRIPTION = 'A media object representing the circumstances before performing this direction.';
    public const LABEL = 'beforeMedia';
    public const NAME = 'schema:beforeMedia';
    public const VALUES = ['MediaObjectModel' => 'Jolicode\SchemaOrg\Type\MediaObjectModel', 'URLModel' => 'Jolicode\SchemaOrg\Type\URLModel'];
    public const TYPES = ['HowToDirection' => 'Jolicode\SchemaOrg\Type\HowToDirectionModel'];
}
