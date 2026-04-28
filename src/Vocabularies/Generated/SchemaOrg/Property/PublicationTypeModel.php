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

final class PublicationTypeModel
{
    public const DESCRIPTION = 'The type of the medical article, taken from the US NLM MeSH publication type catalog. See also [MeSH documentation](http://www.nlm.nih.gov/mesh/pubtypes.html).';
    public const LABEL = 'publicationType';
    public const NAME = 'schema:publicationType';
    public const VALUES = ['TextModel' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\TextModel'];
    public const TYPES = ['MedicalScholarlyArticle' => 'Jolicode\Vocabularies\Generated\SchemaOrg\Type\MedicalScholarlyArticleModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
}
