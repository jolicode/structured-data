<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SchemaOrg\Property;

final class WorkExampleModel
{
    public const DESCRIPTION = 'Example/instance/realization/derivation of the concept of this creative work. E.g. the paperback edition, first edition, or e-book.';
    public const LABEL = 'workExample';
    public const NAME = 'schema:workExample';
    public const VALUES = ['CreativeWorkModel' => 'SchemaOrg\Type\CreativeWorkModel'];
    public const TYPES = ['CreativeWork' => 'SchemaOrg\Type\CreativeWorkModel'];
}
