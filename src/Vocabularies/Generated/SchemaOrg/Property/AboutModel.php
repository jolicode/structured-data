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

final class AboutModel
{
    public const DESCRIPTION = 'The subject matter of an object.';
    public const LABEL = 'about';
    public const NAME = 'schema:about';
    public const VALUES = ['ThingModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\ThingModel'];
    public const TYPES = ['Certification' => 'Jolicode\Vocabularies\SchemaOrg\Type\CertificationModel', 'CommunicateAction' => 'Jolicode\Vocabularies\SchemaOrg\Type\CommunicateActionModel', 'CreativeWork' => 'Jolicode\Vocabularies\SchemaOrg\Type\CreativeWorkModel', 'DefinedTerm' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermModel', 'DefinedTermSet' => 'Jolicode\Vocabularies\SchemaOrg\Type\DefinedTermSetModel', 'Event' => 'Jolicode\Vocabularies\SchemaOrg\Type\EventModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
