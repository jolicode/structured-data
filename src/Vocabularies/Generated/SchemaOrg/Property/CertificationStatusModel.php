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

final class CertificationStatusModel
{
    public const DESCRIPTION = 'Indicates the current status of a certification: active or inactive. See also  [gs1:certificationStatus](https://www.gs1.org/voc/certificationStatus).';
    public const LABEL = 'certificationStatus';
    public const NAME = 'schema:certificationStatus';
    public const VALUES = ['CertificationStatusEnumerationModel' => 'Jolicode\Vocabularies\SchemaOrg\Type\CertificationStatusEnumerationModel'];
    public const TYPES = ['Certification' => 'Jolicode\Vocabularies\SchemaOrg\Type\CertificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
