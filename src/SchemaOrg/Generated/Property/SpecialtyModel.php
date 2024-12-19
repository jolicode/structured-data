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

final class SpecialtyModel
{
    public const DESCRIPTION = 'One of the domain specialities to which this web page\'s content applies.';
    public const LABEL = 'specialty';
    public const NAME = 'schema:specialty';
    public const VALUES = ['SpecialtyModel' => 'Jolicode\SchemaOrg\Type\SpecialtyModel'];
    public const TYPES = ['WebPage' => 'Jolicode\SchemaOrg\Type\WebPageModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
