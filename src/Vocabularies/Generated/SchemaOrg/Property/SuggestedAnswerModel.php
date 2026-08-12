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

final class SuggestedAnswerModel
{
    public const DESCRIPTION = 'An answer (possibly one of several, possibly incorrect) to a Question, e.g. on a Question/Answer site.';
    public const LABEL = 'suggestedAnswer';
    public const NAME = 'schema:suggestedAnswer';
    public const VALUES = ['AnswerModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\AnswerModel', 'ItemListModel' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\ItemListModel'];
    public const TYPES = ['Question' => 'JoliCode\StructuredData\Vocabularies\Generated\SchemaOrg\Type\QuestionModel'];
    public const IS_PART_OF = [];
    public const SOURCE = [];
    public const SUPERSEDED_BY = null;
}
