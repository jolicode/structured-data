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

final class AuditDateModel
{
    public const DESCRIPTION = 'Date when a certification was last audited. See also  [gs1:certificationAuditDate](https://www.gs1.org/voc/certificationAuditDate).';
    public const LABEL = 'auditDate';
    public const NAME = 'schema:auditDate';
    public const VALUES = ['DateModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Certification' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\CertificationModel'];
    public const IS_PART_OF = [];
    public const SOURCE = ['https://github.com/schemaorg/schemaorg/issues/3230'];
    public const SUPERSEDED_BY = null;
}
