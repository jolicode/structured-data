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

final class AboutModel
{
    public const DESCRIPTION = 'The subject matter of the content.';
    public const LABEL = 'about';
    public const NAME = 'schema:about';
    public const VALUES = ['ThingModel' => 'Jolicode\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Certification' => 'Jolicode\SchemaOrg\Type\CertificationModel', 'CommunicateAction' => 'Jolicode\SchemaOrg\Type\CommunicateActionModel', 'CreativeWork' => 'Jolicode\SchemaOrg\Type\CreativeWorkModel', 'Event' => 'Jolicode\SchemaOrg\Type\EventModel'];
}
