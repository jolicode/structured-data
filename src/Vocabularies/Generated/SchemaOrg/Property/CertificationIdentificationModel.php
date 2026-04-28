<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Jolicode\Vocabularies\Generated\SchemaOrg\Property;

final class CertificationIdentificationModel
{
    public const DESCRIPTION = 'Identifier of a certification instance (as registered with an independent certification body). Typically this identifier can be used to consult and verify the certification instance. See also [gs1:certificationIdentification](https://www.gs1.org/voc/certificationIdentification).';
    public const LABEL = 'certificationIdentification';
    public const NAME = 'schema:certificationIdentification';
    public const VALUES = ['DefinedTermModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DefinedTermModel', 'TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['Certification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CertificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
