<?php

/*
 * This file is part of JoliCode's json-ld project.
 *
 * (c) jolicode.com <coucou@jolicode.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Property;

final class ExpiresModel
{
    public const DESCRIPTION = 'Date the content expires and is no longer useful or available. For example a [[VideoObject]] or [[NewsArticle]] whose availability or relevance is time-limited, a [[ClaimReview]] fact check whose publisher wants to indicate that it may no longer be relevant (or helpful to highlight) after some date, or a [[Certification]] the validity has expired.';
    public const LABEL = 'expires';
    public const NAME = 'schema:expires';
    public const VALUES = ['DateModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateModel', 'DateTimeModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\DateTimeModel'];
    public const TYPES = ['Certification' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CertificationModel', 'CreativeWork' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\CreativeWorkModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
